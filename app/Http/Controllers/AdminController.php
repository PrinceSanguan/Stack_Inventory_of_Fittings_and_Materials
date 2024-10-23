<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\PurchaseHistory;

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
            'category' => 'required',
            'description' => 'required',
            'issuance' => 'required',
            'unit_price' => 'required',
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
             'quantity' => $inventory->quantity - $request->issuance,
         ]);

         
         // Check if the is below 10 and mark it for reorder if necessary
        if ($inventory->quantity < 10) {
            $inventory->update([
                'reorder' => 'REORDER',
            ]);
        }

         // add Purchase History
         PurchaseHistory::create([
            'category' => $validated['category'],
            'description' => $validated['description'],
            'issuance' => $validated['issuance'],
            'unit_price' => $validated['unit_price']
         ]);
     
         return redirect()->back()
             ->with('success', 'Purchase order created successfully!');
     }

     public function purchaseHistory() 
     {
        $purchases = PurchaseHistory::all();

        return view ('admin.purchase-history', compact('purchases'));
     }

    public function connection()
    {
        // Retrieve all items in the "connection" category
        $inventorys = Inventory::Where('category', 'connection')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'connection')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'connection')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'connection')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'connection')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'connection')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.connection', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

    public function repair()
    {
        // Retrieve all items in the "repair" category
        $inventorys = Inventory::Where('category', 'repair')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'repair')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'repair')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'repair')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'repair')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'repair')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.repair', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

    public function subsidy()
    {
        // Retrieve all items in the "subsidy" category
        $inventorys = Inventory::Where('category', 'subsidy')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'subsidy')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'subsidy')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'subsidy')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'subsidy')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'subsidy')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.subsidy', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

    public function donation()
    {
        // Retrieve all items in the "donation" category
        $inventorys = Inventory::Where('category', 'donation')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'donation')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'donation')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'donation')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'donation')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'donation')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.donation', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

    public function maintenance()
    {
        // Retrieve all items in the "maintenance" category
        $inventorys = Inventory::Where('category', 'maintenance')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'maintenance')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'maintenance')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'maintenance')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'maintenance')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'maintenance')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.maintenance', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

    public function mswd()
    {
        // Retrieve all items in the "mswd" category
        $inventorys = Inventory::Where('category', 'mswd')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'mswd')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'mswd')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'mswd')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'mswd')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'mswd')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.mswd', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

    public function accountable()
    {
        // Retrieve all items in the "accountable" category
        $inventorys = Inventory::Where('category', 'accountable')->get();

        // Calculate the total sums for the relevant fields
        $totalBalance = Inventory::Where('category', 'accountable')->sum('beginning_balance');
        $totalIssuance = Inventory::Where('category', 'accountable')->sum('issuance');
        $totalPrice = Inventory::Where('category', 'accountable')->sum('unit_price');
        $totalQuantity = Inventory::Where('category', 'accountable')->sum('quantity');
        $totalInventoryValue = Inventory::Where('category', 'accountable')->sum('inventory_value');

        // Pass the calculated sums and the inventory list to the view
        return view('admin.accountable', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalQuantity', 'totalInventoryValue'));
    }

}
