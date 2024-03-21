<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'adminName',
            'email' => 'admin@gmail.com',
            // 'avatar' => 'https://imgs.search.brave.com/vD7HrIZ1kc7PaLLHk-6NpLcjD4nsac98sR6sw3Oc3n8/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9hLnN0/b3J5Ymxvay5jb20v/Zi8xOTE1NzYvMTIw/MHg4MDAvZDBmMjU1/OGFjYi9wcm9maWxl/X3BpY3R1cmVfbWFr/ZXJfYWZ0ZXJfLndl/YnA',
            'role' => 'admin',
            'password' => bcrypt('123456789'),
        ]);
    }
}
