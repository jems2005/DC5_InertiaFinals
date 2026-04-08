<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\InventoryRequest;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    /**
     * Get public statistics for landing page.
     */
    public function index(Request $request)
    {
        return response()->json([
            'total_items' => InventoryItem::count(),
            'total_requests' => InventoryRequest::count(),
            'pending_requests' => InventoryRequest::where('status', 'pending')->count(),
        ]);
    }
}
