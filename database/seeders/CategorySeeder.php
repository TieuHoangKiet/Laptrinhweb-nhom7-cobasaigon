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
        $categories = [
            ['name' => 'Pants', 'description' => 'Quần áo thời trang'],
            ['name' => 'Shirts', 'description' => 'Áo sơ mi, áo phông'],
            ['name' => 'Shoes', 'description' => 'Giày dép'],
            ['name' => 'Hats', 'description' => 'Mũ nón'],
            ['name' => 'Bags', 'description' => 'Túi xách'],
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}