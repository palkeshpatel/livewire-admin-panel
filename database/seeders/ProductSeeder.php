<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Product::count() === 0) {
            Product::create([
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest iPhone with advanced camera system and A17 Pro chip',
                'price' => 999.99,
                'stock' => 50,
                'status' => '1',
                'category_id' => '1',
            ]);

            Product::create([
                'name' => 'MacBook Air M2',
                'description' => 'Ultra-thin laptop with M2 chip for incredible performance',
                'price' => 1199.99,
                'stock' => 25,
                'status' => '1',
                'category_id' => '1',
            ]);

            Product::create([
                'name' => 'AirPods Pro',
                'description' => 'Wireless earbuds with active noise cancellation',
                'price' => 249.99,
                'stock' => 100,
                'status' => '1',
                'category_id' => '1',
            ]);

            Product::create([
                'name' => 'iPad Air',
                'description' => 'Powerful tablet with M1 chip and stunning display',
                'price' => 599.99,
                'stock' => 30,
                'status' => '1',
                'category_id' => '1',
            ]);

            Product::create([
                'name' => 'Apple Watch Series 9',
                'description' => 'Advanced health monitoring and fitness tracking',
                'price' => 399.99,
                'stock' => 75,
                'status' => '1',
                'category_id' => '1',
            ]);
        }
    }
}
