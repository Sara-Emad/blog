<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);
        
        User::factory(50)->create();
        
        $categories = Category::all();
        

        Post::factory(100)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id,
            'category_id' => fn() => $categories->random()->id
        ]);
    }
}