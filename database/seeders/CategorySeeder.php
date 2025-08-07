<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Category::count() === 0) {
            Category::create([
                'name' => 'Cat1',
                'description' => 'Latest iPhone with advanced camera system and A17 Pro chip',

                'status' => '1',

            ]);

            Category::create([
                'name' => 'Cat2',
                'description' => 'Ultra-thin laptop with M2 chip for incredible performance',

                'status' => '1',

            ]);

            Category::create([
                'name' => 'Cat3',
                'description' => 'Ultra-thin laptop with M2 chip for incredible performance',

                'status' => '1',

            ]);
        }
    }
}
