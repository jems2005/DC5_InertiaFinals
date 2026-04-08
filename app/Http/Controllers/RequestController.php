<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveRejectRequest;
use App\Http\Requests\StoreRequestRequest;
use App\Models\InventoryItem;
use App\Models\InventoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RequestController extends Controller
{
    /**
     * Display a listing of requests.
     */
    public function index(Request $request)
    {
        $query = InventoryRequest::with(['item', 'requester', 'reviewer'])
            ->orderBy('created_at', 'desc');

        if ($request->user()?->role !== 'admin') {
            $query->where('user_id', $request->user()->id);
        }

        $status = $request->get('status');
        if ($status && $request->user()?->role === 'admin') {
            $query->where('status', $status);
        }

        $requests = $query->paginate(10);

        return Inertia::render('Requests/Index', [
            'requests' => $requests,
            'filters' => [
                'status' => $status,
            ],
            'canManage' => $request->user()?->role === 'admin',
        ]);
    }

    /**
     * Show the form for creating a new request.
     */
    public function create()
    {
        return Inertia::render('Requests/Create', [
            'items' => InventoryItem::select('id', 'name', 'unit', 'quantity')
                ->orderBy('category')
                ->orderBy('name')
                ->get(),
        ]);
    }

    /**
     * Store a newly created request.
     */
    public function store(StoreRequestRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;

        InventoryRequest::create($validated);

        return redirect()->route('requests.index')
            ->with('success', 'Request submitted successfully.');
    }

    /**
     * Display the specified request.
     */
    public function show(InventoryRequest $request)
    {
        $request->load(['item', 'requester', 'reviewer']);

        return Inertia::render('Requests/Show', [
            'request' => $request,
            'canManage' => auth()->user()?->role === 'admin',
        ]);
    }

    /**
     * Approve the specified request.
     */
    public function approve(ApproveRejectRequest $requestData, InventoryRequest $request)
    {
        DB::transaction(function () use ($request, $requestData) {
            $request->update([
                'status' => 'approved',
                'reviewed_by' => auth()->id(),
                'admin_note' => $requestData->admin_note,
            ]);

            $request->item->decrement('quantity', $request->quantity_requested);
        });

        return redirect()->route('requests.index')
            ->with('success', 'Request approved successfully.');
    }

    /**
     * Reject the specified request.
     */
    public function reject(ApproveRejectRequest $requestData, InventoryRequest $request)
    {
        $request->update([
            'status' => 'rejected',
            'reviewed_by' => auth()->id(),
            'admin_note' => $requestData->admin_note,
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'Request rejected successfully.');
    }
}
