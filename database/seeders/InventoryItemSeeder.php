<?php

namespace Database\Seeders;

use App\Models\InventoryItem;
use Illuminate\Database\Seeder;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Office Supplies
            ['name' => 'A4 Paper Ream', 'category' => 'Paper', 'quantity' => 45, 'unit' => 'reams'],
            ['name' => 'Ballpoint Pens', 'category' => 'Writing', 'quantity' => 120, 'unit' => 'pcs'],
            ['name' => 'Stapler', 'category' => 'Office Tools', 'quantity' => 8, 'unit' => 'pcs'],
            ['name' => 'Staples Box', 'category' => 'Office Supplies', 'quantity' => 25, 'unit' => 'boxes'],
            ['name' => 'Highlighters', 'category' => 'Writing', 'quantity' => 36, 'unit' => 'pcs'],

            // Electronics
            ['name' => 'USB Flash Drive 32GB', 'category' => 'Electronics', 'quantity' => 15, 'unit' => 'pcs'],
            ['name' => 'HDMI Cable 2m', 'category' => 'Cables', 'quantity' => 22, 'unit' => 'pcs'],
            ['name' => 'Extension Cord', 'category' => 'Electronics', 'quantity' => 10, 'unit' => 'pcs'],

            // Cleaning Supplies
            ['name' => 'Liquid Hand Soap', 'category' => 'Cleaning', 'quantity' => 18, 'unit' => 'liters'],
            ['name' => 'Paper Towels', 'category' => 'Cleaning', 'quantity' => 60, 'unit' => 'rolls'],
            ['name' => 'Trash Bags', 'category' => 'Cleaning', 'quantity' => 200, 'unit' => 'pcs'],

            // Warehouse/Storage
            ['name' => 'Cardboard Boxes Medium', 'category' => 'Packaging', 'quantity' => 75, 'unit' => 'pcs'],
            ['name' => 'Bubble Wrap Roll', 'category' => 'Packaging', 'quantity' => 5, 'unit' => 'rolls'],
            ['name' => 'Packing Tape', 'category' => 'Packaging', 'quantity' => 48, 'unit' => 'rolls'],

            // Beverages/Snacks
            ['name' => 'Coffee Instant 500g', 'category' => 'Beverages', 'quantity' => 12, 'unit' => 'jars'],
            ['name' => 'Bottled Water 500ml', 'category' => 'Beverages', 'quantity' => 240, 'unit' => 'bottles'],
            ['name' => 'Tea Bags Box', 'category' => 'Beverages', 'quantity' => 8, 'unit' => 'boxes'],

            // Miscellaneous
            ['name' => 'Whiteboard Markers', 'category' => 'Writing', 'quantity' => 24, 'unit' => 'pcs'],
            ['name' => 'Post-it Notes', 'category' => 'Office Supplies', 'quantity' => 30, 'unit' => 'pads'],
        ];

        foreach ($items as $item) {
            InventoryItem::create($item);
        }
    }
}
