<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all inventory data
        $inventorys = Inventory::all();
    
        // Get the total number of balance in the Inventory table
        $totalBalance = Inventory::sum('balance');
    
        // Get the total number of issuance in the Inventory table
        $totalIssuance = Inventory::sum('issuance');
    
        // Get total number of price in the Inventory table, formatted to 2 decimal places
        $totalPrice = number_format(Inventory::sum('price'), 2, '.', '');
    
        // Get total number of stock in the Inventory table
        $totalStock = Inventory::sum('stock');
    
        // Get total number of value in the Inventory table, formatted to 2 decimal places
        $totalValue = number_format(Inventory::sum('value'), 2, '.', '');
    
        // Pass all values to the view
        return view('admin.dashboard', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function category()
    {
        return view ('admin.category');
    }

    public function addCategory(Request $request)
    {
        // Validate the request data
        $request->validate([
            'reorder' => 'required',
            'inventory' => 'required',
            'description' => 'required',
            'unit' => 'required',
            'balance' => 'required',
            'issuance' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'value' => 'required',
        ]);

        // Saving in the database
        $inventory = Inventory::create([
            'reorder' => $request->input('reorder'),
            'inventory' => $request->input('inventory'),
            'description' => $request->input('description'),
            'unit' => $request->input('unit'),
            'balance' => $request->input('balance'),
            'issuance' => $request->input('issuance'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'value' => $request->input('value'),
        ]);

        if (!$inventory) {
            return redirect()->route('admin.dashboard')->with('error', 'Failed to create inventory');
        }
    
        // Redirect with success message
        return redirect()->route('admin.dashboard')->with('success', 'You successfully created a inventory!');
    }

    public function updateCategory(Request $request)
    {
        $inventory = Inventory::find($request->input('inventoryId'));
    
        // Update inventory attributes
        $inventory->reorder = $request->input('itemReorder');
        $inventory->inventory = $request->input('itemInventory');
        $inventory->description = $request->input('itemDescription');
        $inventory->unit = $request->input('unit');
        $inventory->balance = $request->input('itemBalance');
        $inventory->issuance = $request->input('itemIssuance');
        $inventory->price = $request->input('itemPrice');
        $inventory->stock = $request->input('itemStock');
        $inventory->value = $request->input('itemValue');
    
        // Save changes
        if ($inventory->save()) {
            // Update was successful
            return redirect()->back()->with('success', 'Category updated successfully!');
        } else {
            // Update failed
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }

    public function recordDay()
    {
        return view ('admin.record-day');
    }

    public function recordWeek()
    {
        return view ('admin.record-week');
    }

    public function recordMonth()
    {
        return view ('admin.record-month');
    }

    public function deleteCategory($id)
    {
        $inventory = Inventory::find($id);
    
        if ($inventory) {
            $inventory->delete();
            return response()->json(['success' => 'Deleted successfully.']);
        } else {
            return response()->json(['error' => 'Not found.'], 404);
        }
    }
}
