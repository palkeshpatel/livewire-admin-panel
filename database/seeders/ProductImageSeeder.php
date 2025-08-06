<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        $productImages = [
            [
                "product_id" => 1,
                "image_path" => "products/17.png",
                "is_primary" => true
            ],
            [
                "product_id" => 1,
                "image_path" => "products/18.png",
                "is_primary" => false
            ],
            [
                "product_id" => 2,
                "image_path" => "products/19.png",
                "is_primary" => true
            ],
            [
                "product_id" => 2,
                "image_path" => "products/20.png",
                "is_primary" => false
            ],
            [
                "product_id" => 3,
                "image_path" => "products/21.png",
                "is_primary" => true
            ]
        ];

        foreach ($productImages as $productImage) {
            \App\Models\ProductImage::create($productImage);
        }
    }
}