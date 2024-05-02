<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Models\Post::all();

        $users = \App\Models\User::all();

        foreach ($posts as $post) {
            $numComments = rand(1, 5);

            $shuffledUsers = $users->shuffle();

            for ($i = 0; $i < $numComments && $i < count($shuffledUsers); $i++) {
                DB::table('comments')->insert([
                    'description' => 'Comment ' . ($i + 1) . ' on post ' . $post->id . ' by ' . $shuffledUsers[$i]->name,
                    'user_id' => $shuffledUsers[$i]->id,
                    'post_id' => $post->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
