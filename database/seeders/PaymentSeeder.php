<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $payments = [
            [
                "order_id" => 1,
                "amount" => 1199.98,
                "payment_method" => "credit_card",
                "status" => "completed",
                "transaction_id" => "TXN-001"
            ],
            [
                "order_id" => 2,
                "amount" => 29.99,
                "payment_method" => "paypal",
                "status" => "pending",
                "transaction_id" => "TXN-002"
            ]
        ];

        foreach ($payments as $payment) {
            \App\Models\Payment::create($payment);
        }
    }
}
