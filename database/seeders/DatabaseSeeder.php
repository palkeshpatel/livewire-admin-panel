<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create sample categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics', 'description' => 'Electronic devices and gadgets'],
            ['name' => 'Clothing', 'slug' => 'clothing', 'description' => 'Fashion and apparel'],
            ['name' => 'Books', 'slug' => 'books', 'description' => 'Books and publications'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden', 'description' => 'Home improvement and garden items'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create sample vendors
        $vendors = [
            [
                'user_id' => User::create([
                    'name' => 'Tech Store',
                    'email' => 'tech@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'vendor',
                ])->id,
                'shop_name' => 'Tech Store',
                'shop_slug' => 'tech-store',
                'shop_description' => 'Best electronics store',
                'status' => 'active',
            ],
            [
                'user_id' => User::create([
                    'name' => 'Fashion Hub',
                    'email' => 'fashion@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'vendor',
                ])->id,
                'shop_name' => 'Fashion Hub',
                'shop_slug' => 'fashion-hub',
                'shop_description' => 'Trendy fashion store',
                'status' => 'active',
            ],
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }

        // Create sample products
        $products = [
            [
                'vendor_id' => 1,
                'category_id' => 1,
                'name' => 'Smartphone',
                'slug' => 'smartphone',
                'description' => 'Latest smartphone with amazing features',
                'price' => 29999.00,
                'sale_price' => 24999.00,
                'stock' => 50,
                'status' => 'active',
                'featured' => true,
                'sku' => 'PHONE001',
            ],
            [
                'vendor_id' => 1,
                'category_id' => 1,
                'name' => 'Laptop',
                'slug' => 'laptop',
                'description' => 'High-performance laptop for work and gaming',
                'price' => 59999.00,
                'stock' => 25,
                'status' => 'active',
                'featured' => true,
                'sku' => 'LAPTOP001',
            ],
            [
                'vendor_id' => 2,
                'category_id' => 2,
                'name' => 'T-Shirt',
                'slug' => 't-shirt',
                'description' => 'Comfortable cotton t-shirt',
                'price' => 999.00,
                'sale_price' => 799.00,
                'stock' => 100,
                'status' => 'active',
                'featured' => false,
                'sku' => 'TSHIRT001',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}