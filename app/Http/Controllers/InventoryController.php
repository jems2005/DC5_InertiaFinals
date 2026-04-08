<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    /**
     * Display a listing of inventory items.
     */
    public function index(Request $request)
    {
        $query = InventoryItem::query();

        $items = $query->paginate(10);

        return Inertia::render('Inventory/Index', [
            'items' => $items,
            'canManage' => $request->user()?->role === 'admin',
        ]);
    }

    /**
     * Show the form for creating a new inventory item.
     */
    public function create()
    {
        return Inertia::render('Inventory/Create');
    }

    /**
     * Store a newly created inventory item.
     */
    public function store(StoreItemRequest $request)
    {
        InventoryItem::create($request->validated());

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item created successfully.');
    }

    /**
     * Display the specified inventory item.
     */
    public function show(InventoryItem $item)
    {
        return Inertia::render('Inventory/Show', [
            'item' => $item->loadCount('requests'),
        ]);
    }

    /**
     * Show the form for editing the specified inventory item.
     */
    public function edit(InventoryItem $item)
    {
        return Inertia::render('Inventory/Edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified inventory item.
     */
    public function update(UpdateItemRequest $request, InventoryItem $item)
    {
        $item->update($request->validated());

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified inventory item.
     */
    public function destroy(InventoryItem $item)
    {
        $item->delete();

        return redirect()->route('inventory.index')
            ->with('success', 'Inventory item deleted successfully.');
    }
}
