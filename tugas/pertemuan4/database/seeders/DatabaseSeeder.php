<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 users
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $users[] = User::factory()->create([
                'name' => 'User ' . $i,
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Create 2 categories
        $categories = [
            Category::create([
                'name' => 'Technology',
                'slug' => 'technology',
            ]),
            Category::create([
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
            ]),
        ];

        // Create 10 posts
        Post::factory(10)->recycle($users)->recycle($categories)->create();
    }
}
