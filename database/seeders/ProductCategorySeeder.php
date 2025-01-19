<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronics products'],
            ['name' => 'Clothing', 'description' => 'Clothing products'],
            ['name' => 'Home and Garden', 'description' => 'Home and Garden products'],
            ['name' => 'Sports', 'description' => 'Sports products'],
            ['name' => 'Toys', 'description' => 'Toys products'],
            ['name' => 'Baby', 'description' => 'Baby products'],
            ['name' => 'Beauty and Personal Care', 'description' => 'Beauty and Personal Care products'],
            ['name' => 'Health and Wellness', 'description' => 'Health and Wellness products'],
            ['name' => 'Outdoor and Recreation', 'description' => 'Outdoor and Recreation products'],
            ['name' => 'Pet Supplies', 'description' => 'Pet Supplies products'],
        ];

        foreach ($categories as $category) {
            ProductCategory::create($category);
        }
    }
}
