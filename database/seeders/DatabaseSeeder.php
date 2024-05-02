<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use CommentSeeder;
use Illuminate\Database\Seeder;
use PostSeeder;
use PostVoteSeeder;
use UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(adminSeder::class);
        $this->call(categories::class);
        $this->call(seedUsers::class);
        $this->call(PostsSeeder::class);
        $this->call(CommentsSeeder::class);
        $this->call(PostVotesSeeder::class);
    }
}
