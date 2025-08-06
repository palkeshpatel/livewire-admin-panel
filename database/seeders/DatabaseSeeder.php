<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::create([
            "name" => "Admin User",
            "email" => "admin@example.com",
            "password" => bcrypt("password"),
            "role" => "admin",
            "phone" => "1234567890"
        ]);

        \App\Models\User::create([
            "name" => "Vendor User",
            "email" => "vendor@example.com",
            "password" => bcrypt("password"),
            "role" => "vendor",
            "phone" => "9876543210"
        ]);

        \App\Models\User::create([
            "name" => "Customer User",
            "email" => "customer@example.com",
            "password" => bcrypt("password"),
            "role" => "customer",
            "phone" => "5555555555"
        ]);

        $this->call([
            CategorySeeder::class,
            VendorSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class
        ]);
    }
}
