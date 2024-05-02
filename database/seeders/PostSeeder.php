<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            for ($i = 1; $i <= 3; $i++) {
                    DB::table('posts')->insertGetId([
                    'description' => 'Post ' . $i . ' by ' . $user->name,
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
