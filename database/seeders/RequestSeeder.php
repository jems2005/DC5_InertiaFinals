<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use App\Models\InventoryRequest;
use App\Models\User;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = User::where('role', 'employee')->get();
        $admin = User::where('role', 'admin')->first();
        $items = InventoryItem::all();

        $requestsData = [
            // Pending requests (5)
            ['user_id' => 2, 'item_id' => 1, 'quantity_requested' => 2, 'reason' => 'Need for monthly reports printing', 'status' => 'pending'],
            ['user_id' => 3, 'item_id' => 2, 'quantity_requested' => 5, 'reason' => 'Team meeting presentations', 'status' => 'pending'],
            ['user_id' => 4, 'item_id' => 6, 'quantity_requested' => 1, 'reason' => 'Project data backup', 'status' => 'pending'],
            ['user_id' => 5, 'item_id' => 9, 'quantity_requested' => 3, 'reason' => 'Office kitchen restock', 'status' => 'pending'],
            ['user_id' => 6, 'item_id' => 16, 'quantity_requested' => 12, 'reason' => 'Weekly team hydration', 'status' => 'pending'],

            // Approved requests (5)
            ['user_id' => 2, 'item_id' => 5, 'quantity_requested' => 3, 'reason' => 'Document highlighting needs', 'status' => 'approved', 'reviewed_by' => $admin->id, 'admin_note' => 'Approved for Q4 review prep'],
            ['user_id' => 3, 'item_id' => 12, 'quantity_requested' => 10, 'reason' => 'Shipping department packaging', 'status' => 'approved', 'reviewed_by' => $admin->id, 'admin_note' => 'Standard shipping allocation'],
            ['user_id' => 4, 'item_id' => 17, 'quantity_requested' => 4, 'reason' => 'Conference room whiteboard', 'status' => 'approved', 'reviewed_by' => $admin->id, 'admin_note' => 'Approved for meetings'],
            ['user_id' => 5, 'item_id' => 10, 'quantity_requested' => 20, 'reason' => 'Lunch break cleaning', 'status' => 'approved', 'reviewed_by' => $admin->id, 'admin_note' => 'Bulk cleaning supplies'],
            ['user_id' => 6, 'item_id' => 7, 'quantity_requested' => 2, 'reason' => 'AV setup for training', 'status' => 'approved', 'reviewed_by' => $admin->id, 'admin_note' => 'Training session approved'],

            // Rejected requests (5)
            ['user_id' => 2, 'item_id' => 3, 'quantity_requested' => 10, 'reason' => 'Personal stapler collection', 'status' => 'rejected', 'reviewed_by' => $admin->id, 'admin_note' => 'Business use only - limit to 1 per employee'],
            ['user_id' => 3, 'item_id' => 8, 'quantity_requested' => 15, 'reason' => 'Home office setup', 'status' => 'rejected', 'reviewed_by' => $admin->id, 'admin_note' => 'Company assets only'],
            ['user_id' => 4, 'item_id' => 14, 'quantity_requested' => 50, 'reason' => 'Event decoration', 'status' => 'rejected', 'reviewed_by' => $admin->id, 'admin_note' => 'Excessive quantity - limit 10'],
            ['user_id' => 5, 'item_id' => 18, 'quantity_requested' => 100, 'reason' => 'Personal tea collection', 'status' => 'rejected', 'reviewed_by' => $admin->id, 'admin_note' => 'Standard allocation: 1 box max'],
            ['user_id' => 6, 'item_id' => 11, 'quantity_requested' => 500, 'reason' => 'Large cleanup project', 'status' => 'rejected', 'reviewed_by' => $admin->id, 'admin_note' => 'Budget exceeded - use contractor'],
        ];

        foreach ($requestsData as $data) {
            InventoryRequest::create($data);
        }
    }
}
