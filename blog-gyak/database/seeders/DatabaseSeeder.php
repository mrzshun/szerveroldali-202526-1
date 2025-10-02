<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users          = User::factory(10)->create();
        $categories     = Category::factory(fake()->numberBetween(5,8))->create();
        $posts          = Post::factory(fake()->numberBetween(12,18))->create();

        foreach($posts as $post) {
            if(rand(1,10)>3) {
                $post->author()->associate($users->random())->save();
            }
            $post->categories()->sync(
                $categories->random(rand(1,$categories->count()))
            );
        }
    }
}
