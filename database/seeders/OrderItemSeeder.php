<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orderItems = [
            [
                "order_id" => 1,
                "product_id" => 1,
                "vendor_id" => 1,
                "quantity" => 1,
                "price" => 999.99
            ],
            [
                "order_id" => 1,
                "product_id" => 2,
                "vendor_id" => 1,
                "quantity" => 1,
                "price" => 199.99
            ],
            [
                "order_id" => 2,
                "product_id" => 3,
                "vendor_id" => 2,
                "quantity" => 1,
                "price" => 29.99
            ]
        ];

        foreach ($orderItems as $orderItem) {
            \App\Models\OrderItem::create($orderItem);
        }
    }
} 