<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class AdminController extends Controller
{

    public function category()
    {
        return view ('admin.category');
    }

    public function addItem(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'category' => 'required',
            'unit' => 'required',
            'unit_price' => 'required|numeric|min:0',
            'description' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);
    
        // Check if item already exists with same category, unit and description
        $existingItem = Inventory::where('category', $validated['category'])
            ->where('unit', $validated['unit'])
            ->where('description', $validated['description'])
            ->first();
    
        if ($existingItem) {
            // Update existing item
            $newQuantity = $existingItem->quantity + $validated['quantity'];
            $newBeginningBalance = $existingItem->beginning_balance + $validated['quantity'];
            
            $existingItem->update([
                'quantity' => $newQuantity,
                'beginning_balance' => $newBeginningBalance,
                'unit_price' => $validated['unit_price'], // Update price if changed
                'inventory_value' => $validated['unit_price'] * $newQuantity
            ]);
    
            return redirect()->route('admin.category')
                ->with('success', 'Inventory item updated successfully!');
        }
    
        // Create new item if it doesn't exist
        $inventory = Inventory::create([
            'category' => $validated['category'],
            'unit' => $validated['unit'],
            'unit_price' => $validated['unit_price'],
            'description' => $validated['description'],
            'quantity' => $validated['quantity'],
            'beginning_balance' => $validated['quantity'],
            'issuance' => 0,
            'inventory_value' => $validated['unit_price'] * $validated['quantity']
        ]);
    
        // Update the same record with inventory_no using its ID
        $inventory->update([
            'inventory_no' => $inventory->id
        ]);
    
        return redirect()->route('admin.category')
            ->with('success', 'New inventory item created successfully!');
    }

     // Get descriptions based on selected category
     public function getDescriptions(Request $request)
     {
         $category = $request->category;
         
         $descriptions = Inventory::where('category', $category)
             ->select('description')
             ->distinct()
             ->get();
             
         return response()->json($descriptions);
     }
 
     // Get item details based on selected description and category
     public function getItemDetails(Request $request)
     {
         $item = Inventory::where('category', $request->category)
             ->where('description', $request->description)
             ->select('inventory_no', 'quantity', 'unit', 'unit_price')
             ->first();
             
         return response()->json($item);
     }

     public function purchase()
     {
        return view ('admin.purchase');
     }

     public function addPurchase(Request $request)
     {
         // Validate the request
         $validated = $request->validate([
             'inventory_no' => 'required|exists:inventories,inventory_no',
             'issuance' => 'required|integer|min:1',
         ]);
     
         // Find the inventory item
         $inventory = Inventory::where('inventory_no', $request->inventory_no)->first();
     
         // Check if we have enough stock
         if ($inventory->beginning_balance < $request->issuance) {
             return redirect()->back()
                 ->with('error', 'Not enough stock available. Current stock: ' . $inventory->beginning_balance)
                 ->withInput();
         }
     
         // Update the inventory
         $inventory->update([
             'issuance' => $inventory->issuance + $request->issuance,
             'beginning_balance' => $inventory->beginning_balance - $request->issuance,
         ]);
     
         return redirect()->back()
             ->with('success', 'Purchase order created successfully!');
     }

}
