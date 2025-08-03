<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        // Create some sample users if they don't exist
        if (User::count() < 11) {
            User::factory(10)->create();
        }

        // Create sample products if they don't exist
        if (Product::count() === 0) {
            Product::create([
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest iPhone with advanced camera system and A17 Pro chip',
                'price' => 999.99,
                'stock' => 50,
                'status' => 'active'
            ]);

            Product::create([
                'name' => 'MacBook Air M2',
                'description' => 'Ultra-thin laptop with M2 chip for incredible performance',
                'price' => 1199.99,
                'stock' => 25,
                'status' => 'active'
            ]);

            Product::create([
                'name' => 'AirPods Pro',
                'description' => 'Wireless earbuds with active noise cancellation',
                'price' => 249.99,
                'stock' => 100,
                'status' => 'active'
            ]);

            Product::create([
                'name' => 'iPad Air',
                'description' => 'Powerful tablet with M1 chip and stunning display',
                'price' => 599.99,
                'stock' => 30,
                'status' => 'active'
            ]);

            Product::create([
                'name' => 'Apple Watch Series 9',
                'description' => 'Advanced health monitoring and fitness tracking',
                'price' => 399.99,
                'stock' => 75,
                'status' => 'active'
            ]);
        }
    }
}
