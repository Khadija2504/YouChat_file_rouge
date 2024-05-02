<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class seedUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 20 users with role 'user'
        for ($i = 1; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => 'User' . $i,
                'user_name' => 'user_' . $i,
                'avatar' => 'avatar_' . $i . '.jpg',
                'email' => 'user' . $i . '@example.com',
                'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'contry' => 'Country' . $i,
                'city' => 'City' . $i,
                'email_verified_at' => now(),
                'ban' => false,
                'status' => 'active',
                'role' => 'user',
                'acceptation' => 'auto',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
