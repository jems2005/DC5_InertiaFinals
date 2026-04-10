<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use App\Models\InventoryRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with summary statistics.
     */
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'auth' => [
                'user' => $request->user(),
            ],
            'stats' => [
                'total_items' => InventoryItem::count(),
                'pending_requests' => InventoryRequest::where('status', 'pending')->count(),
                'approved_today' => InventoryRequest::where('status', 'approved')
                    ->whereDate('updated_at', today())
                    ->count(),
            ],
        ]);
    }
}
