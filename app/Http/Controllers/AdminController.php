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
            'category' => 'required',
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
            'category' => $request->input('category'),
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

    public function connection()
    {
        // Fetch all inventory data where category is 'connection'
        $inventorys = Inventory::where('category', 'connection')->get();
    
        // Get the total number of balance where category is 'connection'
        $totalBalance = Inventory::where('category', 'connection')->sum('balance');
    
        // Get the total number of issuance where category is 'connection'
        $totalIssuance = Inventory::where('category', 'connection')->sum('issuance');
    
        // Get total number of price where category is 'connection', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'connection')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'connection'
        $totalStock = Inventory::where('category', 'connection')->sum('stock');
    
        // Get total number of value where category is 'connection', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'connection')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.connection', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function repair()
    {
        // Fetch all inventory data where category is 'repair'
        $inventorys = Inventory::where('category', 'repair')->get();
    
        // Get the total number of balance where category is 'repair'
        $totalBalance = Inventory::where('category', 'repair')->sum('balance');
    
        // Get the total number of issuance where category is 'repair'
        $totalIssuance = Inventory::where('category', 'repair')->sum('issuance');
    
        // Get total number of price where category is 'repair', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'repair')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'repair'
        $totalStock = Inventory::where('category', 'repair')->sum('stock');
    
        // Get total number of value where category is 'repair', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'repair')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.repair', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function subsidy()
    {
        // Fetch all inventory data where category is 'subsidy'
        $inventorys = Inventory::where('category', 'subsidy')->get();
    
        // Get the total number of balance where category is 'subsidy'
        $totalBalance = Inventory::where('category', 'subsidy')->sum('balance');
    
        // Get the total number of issuance where category is 'subsidy'
        $totalIssuance = Inventory::where('category', 'subsidy')->sum('issuance');
    
        // Get total number of price where category is 'subsidy', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'subsidy')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'subsidy'
        $totalStock = Inventory::where('category', 'subsidy')->sum('stock');
    
        // Get total number of value where category is 'subsidy', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'subsidy')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.subsidy', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function donation()
    {
        // Fetch all inventory data where category is 'donation'
        $inventorys = Inventory::where('category', 'donation')->get();
    
        // Get the total number of balance where category is 'donation'
        $totalBalance = Inventory::where('category', 'donation')->sum('balance');
    
        // Get the total number of issuance where category is 'donation'
        $totalIssuance = Inventory::where('category', 'donation')->sum('issuance');
    
        // Get total number of price where category is 'donation', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'donation')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'donation'
        $totalStock = Inventory::where('category', 'donation')->sum('stock');
    
        // Get total number of value where category is 'donation', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'donation')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.donation', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function maintenance()
    {
        // Fetch all inventory data where category is 'maintenance'
        $inventorys = Inventory::where('category', 'maintenance')->get();
    
        // Get the total number of balance where category is 'maintenance'
        $totalBalance = Inventory::where('category', 'maintenance')->sum('balance');
    
        // Get the total number of issuance where category is 'maintenance'
        $totalIssuance = Inventory::where('category', 'maintenance')->sum('issuance');
    
        // Get total number of price where category is 'maintenance', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'maintenance')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'maintenance'
        $totalStock = Inventory::where('category', 'maintenance')->sum('stock');
    
        // Get total number of value where category is 'maintenance', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'maintenance')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.maintenance', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function mswd()
    {
        // Fetch all inventory data where category is 'mswd'
        $inventorys = Inventory::where('category', 'mswd')->get();
    
        // Get the total number of balance where category is 'mswd'
        $totalBalance = Inventory::where('category', 'mswd')->sum('balance');
    
        // Get the total number of issuance where category is 'mswd'
        $totalIssuance = Inventory::where('category', 'mswd')->sum('issuance');
    
        // Get total number of price where category is 'mswd', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'mswd')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'mswd'
        $totalStock = Inventory::where('category', 'mswd')->sum('stock');
    
        // Get total number of value where category is 'mswd', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'mswd')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.mswd', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function accountable()
    {
        // Fetch all inventory data where category is 'accountable'
        $inventorys = Inventory::where('category', 'accountable')->get();
    
        // Get the total number of balance where category is 'accountable'
        $totalBalance = Inventory::where('category', 'accountable')->sum('balance');
    
        // Get the total number of issuance where category is 'accountable'
        $totalIssuance = Inventory::where('category', 'accountable')->sum('issuance');
    
        // Get total number of price where category is 'accountable', formatted to 2 decimal places
        $totalPrice = number_format(Inventory::where('category', 'accountable')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'accountable'
        $totalStock = Inventory::where('category', 'accountable')->sum('stock');
    
        // Get total number of value where category is 'accountable', formatted to 2 decimal places
        $totalValue = number_format(Inventory::where('category', 'accountable')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.accountable', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }
}
