<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 users first
        User::factory(50)->create();
        
        // Create 100 posts and associate them with random users
        Post::factory(100)->create([
            'user_id' => fn() => User::inRandomOrder()->first()->id
        ]);
    }
}