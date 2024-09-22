<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exampleCategories = ['Bug', 'Feature', 'Improvement'];
        $categories = [];

        foreach ($exampleCategories as $exampleCategory) {
            $categories[] = [
                'title' => $exampleCategory,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Category::insert($categories);
    }
}
