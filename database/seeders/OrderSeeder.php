<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = [
            [
                "customer_id" => 3, // Customer User
                "total_amount" => 1199.98,
                "status" => "completed",
                "payment_status" => "paid",
                "shipping_address" => "123 Main St, City, State 12345"
            ],
            [
                "customer_id" => 3, // Customer User
                "total_amount" => 29.99,
                "status" => "pending",
                "payment_status" => "pending",
                "shipping_address" => "456 Oak Ave, City, State 12345"
            ]
        ];

        foreach ($orders as $order) {
            \App\Models\Order::create($order);
        }
    }
} 