<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostVotesSeeder extends Seeder
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

        $voteTypes = ['like', 'dislike'];

        foreach ($posts as $post) {
            $numVotes = rand(10, 20);

            $shuffledUsers = $users->shuffle();

            for ($i = 0; $i < $numVotes && $i < count($shuffledUsers); $i++) {
                DB::table('post_votes')->insert([
                    'user_id' => $shuffledUsers[$i]->id,
                    'post_id' => $post->id,
                    'vote' => $voteTypes[rand(0, 1)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
