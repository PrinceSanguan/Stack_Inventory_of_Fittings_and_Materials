<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Connection;
use App\Models\Repair;
use App\Models\Accountable;
use App\Models\Donation;
use App\Models\Maintenance;
use App\Models\Mswd;
use App\Models\Subsidy;

class AdminController extends Controller
{

        public function index()
    {
        // Fetch all data from each table
        $connections = Connection::all();
        $repairs = Repair::all();
        $accountables = Accountable::all();
        $donations = Donation::all();
        $maintenances = Maintenance::all();
        $mswds = Mswd::all();
        $subsidies = Subsidy::all();

        // Combine all records into one collection
        $inventorys = collect()
            ->merge($connections)
            ->merge($repairs)
            ->merge($accountables)
            ->merge($donations)
            ->merge($maintenances)
            ->merge($mswds)
            ->merge($subsidies);

        // Calculate totals for each field
        $totalBalance = $inventorys->sum('balance');
        $totalIssuance = $inventorys->sum('issuance');
        $totalPrice = number_format($inventorys->sum('price'), 2, '.', '');
        $totalStock = $inventorys->sum('stock');
        $totalValue = number_format($inventorys->sum('value'), 2, '.', '');

        // Pass the data and totals to the view
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

    // Handle the category-specific logic based on 'category' input
    if ($request->input('category') === 'connection') {
        Connection::create([
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
    } elseif ($request->input('category') === 'repair') {
        Repair::create([
            'category' => $request->input('category'),// Get the id of the created inventory
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
    } elseif ($request->input('category') === 'subsidy') {
        Subsidy::create([
            'category' => $request->input('category'),// Get the id of the created inventory
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
    } elseif ($request->input('category') === 'donation') {
        Donation::create([
            'category' => $request->input('category'),// Get the id of the created inventory
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
    } elseif ($request->input('category') === 'maintenance') {
        Maintenance::create([
            'category' => $request->input('category'),// Get the id of the created inventory
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
    } elseif ($request->input('category') === 'mswd') {
        Mswd::create([
            'category' => $request->input('category'),// Get the id of the created inventory
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
    } elseif ($request->input('category') === 'accountable') {
        Accountable::create([
            'category' => $request->input('category'),// Get the id of the created inventory
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
    }

    // Redirect with success message after successful creation
    return redirect()->route('admin.category')->with('success', 'You successfully created an inventory!');
}

public function updateCategory(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'inventoryId' => 'required',
        'itemCategory' => 'required',
        'itemReorder' => 'required',
        'itemInventory' => 'required|numeric',
        'itemDescription' => 'required',
        'unit' => 'required',
        'itemBalance' => 'required|numeric|min:0',
        'itemIssuance' => 'required|numeric|min:0',
        'itemPrice' => 'required|numeric|min:0',
        'itemStock' => 'required|numeric|min:0',
        'itemValue' => 'required|numeric|min:0',
    ]);

    // Retrieve the category and inventory ID from the request
    $inventoryId = $request->input('inventoryId');
    $category = $request->input('itemCategory');

    // Determine which model to use based on the category
    switch ($category) {
        case 'connection':
            $inventory = Connection::find($inventoryId);
            break;
        case 'repair':
            $inventory = Repair::find($inventoryId);
            break;
        case 'accountable':
            $inventory = Accountable::find($inventoryId);
            break;
        case 'donation':
            $inventory = Donation::find($inventoryId);
            break;
        case 'maintenance':
            $inventory = Maintenance::find($inventoryId);
            break;
        case 'mswd':
            $inventory = Mswd::find($inventoryId);
            break;
        case 'subsidy':
            $inventory = Subsidy::find($inventoryId);
            break;
        default:
            return redirect()->back()->with('error', 'Invalid category specified.');
    }

    // Check if the inventory record was found
    if (!$inventory) {
        return redirect()->back()->with('error', 'Inventory not found.');
    }

    // Update the inventory fields with the new values from the form
    $inventory->reorder = $request->input('itemReorder');
    $inventory->inventory = $request->input('itemInventory');
    $inventory->description = $request->input('itemDescription');
    $inventory->unit = $request->input('unit');
    $inventory->balance = $request->input('itemBalance');
    $inventory->issuance = $request->input('itemIssuance');
    $inventory->price = $request->input('itemPrice');
    $inventory->stock = $request->input('itemStock');
    $inventory->value = $request->input('itemValue');

    // Save the changes
    if ($inventory->save()) {
        // Update was successful
        return redirect()->back()->with('success', 'Category updated successfully!');
    } else {
        // Update failed
        return redirect()->back()->with('error', 'Failed to update category.');
    }
}

    public function deleteCategory($id, $category)
    {
    // Determine which model to use based on the category
    switch ($category) {
        case 'connection':
            $inventory = Connection::find($id);
            break;
        case 'repair':
            $inventory = Repair::find($id);
            break;
        case 'accountable':
            $inventory = Accountable::find($id);
            break;
        case 'donation':
            $inventory = Donation::find($id);
            break;
        case 'maintenance':
            $inventory = Maintenance::find($id);
            break;
        case 'mswd':
            $inventory = Mswd::find($id);
            break;
        case 'subsidy':
            $inventory = Subsidy::find($id);
            break;
        default:
            return response()->json(['error' => 'Invalid category.'], 400); // Bad request if invalid category
    }

        // Check if the inventory record exists
        if ($inventory) {
            $inventory->delete();
            return response()->json(['success' => 'Deleted successfully.']);
        } else {
            return response()->json(['error' => 'Not found.'], 404); // Not found error
        }
    }

    public function connection()
    {
        // Fetch all inventory data where category is 'connection'
        $inventorys = Connection::where('category', 'connection')->get();
    
        // Get the total number of balance where category is 'connection'
        $totalBalance = Connection::where('category', 'connection')->sum('balance');
    
        // Get the total number of issuance where category is 'connection'
        $totalIssuance = Connection::where('category', 'connection')->sum('issuance');
    
        // Get total number of price where category is 'connection', formatted to 2 decimal places
        $totalPrice = number_format(Connection::where('category', 'connection')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'connection'
        $totalStock = Connection::where('category', 'connection')->sum('stock');
    
        // Get total number of value where category is 'connection', formatted to 2 decimal places
        $totalValue = number_format(Connection::where('category', 'connection')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.connection', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function repair()
    {
        // Fetch all inventory data where category is 'repair'
        $inventorys = Repair::where('category', 'repair')->get();
    
        // Get the total number of balance where category is 'repair'
        $totalBalance = Repair::where('category', 'repair')->sum('balance');
    
        // Get the total number of issuance where category is 'repair'
        $totalIssuance = Repair::where('category', 'repair')->sum('issuance');
    
        // Get total number of price where category is 'repair', formatted to 2 decimal places
        $totalPrice = number_format(Repair::where('category', 'repair')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'repair'
        $totalStock = Repair::where('category', 'repair')->sum('stock');
    
        // Get total number of value where category is 'repair', formatted to 2 decimal places
        $totalValue = number_format(Repair::where('category', 'repair')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.repair', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function subsidy()
    {
        // Fetch all inventory data where category is 'subsidy'
        $inventorys = Subsidy::where('category', 'subsidy')->get();
    
        // Get the total number of balance where category is 'subsidy'
        $totalBalance = Subsidy::where('category', 'subsidy')->sum('balance');
    
        // Get the total number of issuance where category is 'subsidy'
        $totalIssuance = Subsidy::where('category', 'subsidy')->sum('issuance');
    
        // Get total number of price where category is 'subsidy', formatted to 2 decimal places
        $totalPrice = number_format(Subsidy::where('category', 'subsidy')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'subsidy'
        $totalStock = Subsidy::where('category', 'subsidy')->sum('stock');
    
        // Get total number of value where category is 'subsidy', formatted to 2 decimal places
        $totalValue = number_format(Subsidy::where('category', 'subsidy')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.subsidy', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function donation()
    {
        // Fetch all inventory data where category is 'donation'
        $inventorys = Donation::where('category', 'donation')->get();
    
        // Get the total number of balance where category is 'donation'
        $totalBalance = Donation::where('category', 'donation')->sum('balance');
    
        // Get the total number of issuance where category is 'donation'
        $totalIssuance = Donation::where('category', 'donation')->sum('issuance');
    
        // Get total number of price where category is 'donation', formatted to 2 decimal places
        $totalPrice = number_format(Donation::where('category', 'donation')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'donation'
        $totalStock = Donation::where('category', 'donation')->sum('stock');
    
        // Get total number of value where category is 'donation', formatted to 2 decimal places
        $totalValue = number_format(Donation::where('category', 'donation')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.donation', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function maintenance()
    {
        // Fetch all inventory data where category is 'maintenance'
        $inventorys = Maintenance::where('category', 'maintenance')->get();
    
        // Get the total number of balance where category is 'maintenance'
        $totalBalance = Maintenance::where('category', 'maintenance')->sum('balance');
    
        // Get the total number of issuance where category is 'maintenance'
        $totalIssuance = Maintenance::where('category', 'maintenance')->sum('issuance');
    
        // Get total number of price where category is 'maintenance', formatted to 2 decimal places
        $totalPrice = number_format(Maintenance::where('category', 'maintenance')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'maintenance'
        $totalStock = Maintenance::where('category', 'maintenance')->sum('stock');
    
        // Get total number of value where category is 'maintenance', formatted to 2 decimal places
        $totalValue = number_format(Maintenance::where('category', 'maintenance')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.maintenance', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function mswd()
    {
        // Fetch all inventory data where category is 'mswd'
        $inventorys = Mswd::where('category', 'mswd')->get();
    
        // Get the total number of balance where category is 'mswd'
        $totalBalance = Mswd::where('category', 'mswd')->sum('balance');
    
        // Get the total number of issuance where category is 'mswd'
        $totalIssuance = Mswd::where('category', 'mswd')->sum('issuance');
    
        // Get total number of price where category is 'mswd', formatted to 2 decimal places
        $totalPrice = number_format(Mswd::where('category', 'mswd')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'mswd'
        $totalStock = Mswd::where('category', 'mswd')->sum('stock');
    
        // Get total number of value where category is 'mswd', formatted to 2 decimal places
        $totalValue = number_format(Mswd::where('category', 'mswd')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.mswd', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function accountable()
    {
        // Fetch all inventory data where category is 'accountable'
        $inventorys = Accountable::where('category', 'accountable')->get();
    
        // Get the total number of balance where category is 'accountable'
        $totalBalance = Accountable::where('category', 'accountable')->sum('balance');
    
        // Get the total number of issuance where category is 'accountable'
        $totalIssuance = Accountable::where('category', 'accountable')->sum('issuance');
    
        // Get total number of price where category is 'accountable', formatted to 2 decimal places
        $totalPrice = number_format(Accountable::where('category', 'accountable')->sum('price'), 2, '.', '');
    
        // Get total number of stock where category is 'accountable'
        $totalStock = Accountable::where('category', 'accountable')->sum('stock');
    
        // Get total number of value where category is 'accountable', formatted to 2 decimal places
        $totalValue = number_format(Accountable::where('category', 'accountable')->sum('value'), 2, '.', '');
    
        // Return the view with the filtered inventory data and totals
        return view('admin.accountable', compact('inventorys', 'totalBalance', 'totalIssuance', 'totalPrice', 'totalStock', 'totalValue'));
    }

    public function purchase()
    {
        return view ('admin.purchase');
    }

    public function purchaseHistory()
    {
        $purchases = Purchase::all();

        return view ('admin.purchase-history', compact('purchases'));
    }

    public function addPurchase(Request $request)
    {
        // Validate the request data
        $request->validate([
            'category' => 'required',
            'reorder' => 'required',
            'inventory' => 'required',
            'description' => 'required',
            'unit' => 'required',
            'balance' => 'required|numeric|min:0',
            'issuance' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'value' => 'required|numeric|min:0',
        ]);

        // Based on the category, find the correct inventory model
        $category = $request->input('category');
        switch ($category) {
            case 'connection':
                $inventory = Connection::where('inventory', $request->input('inventory'))->first();
                break;
            case 'repair':
                $inventory = Repair::where('inventory', $request->input('inventory'))->first();
                break;
            case 'accountable':
                $inventory = Accountable::where('inventory', $request->input('inventory'))->first();
                break;
            case 'donation':
                $inventory = Donation::where('inventory', $request->input('inventory'))->first();
                break;
            case 'maintenance':
                $inventory = Maintenance::where('inventory', $request->input('inventory'))->first();
                break;
            case 'mswd':
                $inventory = Mswd::where('inventory', $request->input('inventory'))->first();
                break;
            case 'subsidy':
                $inventory = Subsidy::where('inventory', $request->input('inventory'))->first();
                break;
            default:
                return redirect()->back()->with('error', 'Invalid category provided.');
        }

        // If inventory item is not found, return an error
        if (!$inventory) {
            return redirect()->back()->with('error', 'Inventory item not found.');
        }

        // Check if the balance, issuance, or stock adjustments will become negative
        $newBalance = $inventory->balance - $request->input('balance');
        $newIssuance = $inventory->issuance - $request->input('issuance');
        $newStock = $inventory->stock - $request->input('stock');

        if ($newBalance < 0) {
            return redirect()->back()->with('error', 'The balance will become negative.');
        }

        if ($newIssuance < 0) {
            return redirect()->back()->with('error', 'The issuance will become negative.');
        }

        if ($newStock < 0) {
            return redirect()->back()->with('error', 'The stock will become negative.');
        }

        // Update the inventory with the new values
        $inventory->balance = $newBalance;
        $inventory->issuance = $newIssuance;
        $inventory->stock = $newStock;

        // Save the updated inventory data
        if (!$inventory->save()) {
            return redirect()->back()->with('error', 'Failed to update inventory.');
        }

        // Create the purchase record in the Purchase table
        $purchase = Purchase::create([
            'category' => $category,
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

        if (!$purchase) {
            return redirect()->route('admin.purchase')->with('error', 'Failed to create purchase.');
        }

        // Redirect with success message
        return redirect()->route('admin.purchase')->with('success', 'You successfully created a purchase.');
    }
}
