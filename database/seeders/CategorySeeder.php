<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'description' => 'Articles about the latest technological developments'
            ],
            [
                'name' => 'Health',
                'description' => 'Tips and information for maintaining good health'
            ],
            [
                'name' => 'Education',
                'description' => 'Educational resources and tips for students and teachers'
            ],
            [
                'name' => 'Travel',
                'description' => 'Experiences and tips for travelers'
            ],
            [
                'name' => 'Cooking',
                'description' => 'Recipes and various cooking techniques'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}