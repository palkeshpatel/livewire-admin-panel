<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                "name" => "Electronics",
                "slug" => "electronics",
                "description" => "Electronic devices and accessories"
            ],
            [
                "name" => "Fashion",
                "slug" => "fashion",
                "description" => "Clothing, shoes, and accessories"
            ],
            [
                "name" => "Home & Living",
                "slug" => "home-living",
                "description" => "Home decor and furniture"
            ],
            [
                "name" => "Books",
                "slug" => "books",
                "description" => "Books and educational materials"
            ]
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
