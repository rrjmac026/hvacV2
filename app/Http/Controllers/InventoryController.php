<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('product')->latest()->paginate(10);
        return view('inventory.index', compact('inventories'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'batch_number' => 'nullable|string',
            'expiry_date' => 'nullable|date',
            'unit_cost' => 'required|numeric|min:0',
            'supplier' => 'nullable|string',
            'status' => 'required|in:in_stock,low_stock,out_of_stock',
            'notes' => 'nullable|string'
        ]);

        Inventory::create($validated);
        return redirect()->route('inventory.index')->with('success', 'Inventory item added successfully');
    }

    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        $products = Product::all();
        return view('inventory.edit', compact('inventory', 'products'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0',
            'batch_number' => 'nullable|string',
            'expiry_date' => 'nullable|date',
            'unit_cost' => 'required|numeric|min:0',
            'supplier' => 'nullable|string',
            'status' => 'required|in:in_stock,low_stock,out_of_stock',
            'notes' => 'nullable|string'
        ]);

        $inventory->update($validated);
        return redirect()->route('inventory.index')->with('success', 'Inventory updated successfully');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('inventory.index')->with('success', 'Inventory item deleted successfully');
    }
}
