<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                "vendor_id" => 1,
                "category_id" => 1,
                "name" => "Latest Smartphone",
                "slug" => "latest-smartphone",
                "description" => "High-end smartphone with amazing features",
                "price" => 999.99,
                "stock" => 50,
                "status" => "active"
            ],
            [
                "vendor_id" => 1,
                "category_id" => 1,
                "name" => "Wireless Earbuds",
                "slug" => "wireless-earbuds",
                "description" => "Premium wireless earbuds with noise cancellation",
                "price" => 199.99,
                "stock" => 100,
                "status" => "active"
            ],
            [
                "vendor_id" => 2,
                "category_id" => 2,
                "name" => "Designer T-Shirt",
                "slug" => "designer-t-shirt",
                "description" => "Premium cotton t-shirt",
                "price" => 29.99,
                "stock" => 200,
                "status" => "active"
            ]
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
} 