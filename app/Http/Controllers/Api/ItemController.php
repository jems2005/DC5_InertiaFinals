<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a paginated listing of inventory items.
     */
    public function index(Request $request)
    {
        $items = InventoryItem::query()
            ->withCount('requests')
            ->paginate(12);

        return response()->json($items);
    }

    /**
     * Display the specified inventory item.
     */
    public function show(InventoryItem $item)
    {
        $item->loadCount('requests');

        return response()->json($item);
    }
}
