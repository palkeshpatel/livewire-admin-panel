<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $vendors = [
            [
                "user_id" => 2, // Vendor User
                "shop_name" => "Electronics Hub",
                "shop_slug" => "electronics-hub",
                "shop_description" => "Your one-stop shop for all electronics",
                "status" => "active"
            ],
            [
                "user_id" => 2, // Same vendor
                "shop_name" => "Fashion Store",
                "shop_slug" => "fashion-store",
                "shop_description" => "Latest fashion trends",
                "status" => "active"
            ]
        ];

        foreach ($vendors as $vendor) {
            \App\Models\Vendor::create($vendor);
        }
    }
}
