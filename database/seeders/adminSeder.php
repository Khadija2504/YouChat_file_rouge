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
            'avatar' => 'https://imgs.search.brave.com/vD7HrIZ1kc7PaLLHk-6NpLcjD4nsac98sR6sw3Oc3n8/rs:fit:500:0:0/g:ce/aHR0cHM6Ly9hLnN0/b3J5Ymxvay5jb20v/Zi8xOTE1NzYvMTIw/MHg4MDAvZDBmMjU1/OGFjYi9wcm9maWxl/X3BpY3R1cmVfbWFr/ZXJfYWZ0ZXJfLndl/YnA',
            'user_name' => 'admin#1234',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, recusandae, laudantium ipsum ut facere vel porro soluta quis corporis obcaecati, accusamus iusto optio nulla doloremque perspiciatis accusantium sint quisquam deleniti qui? Magnam nostrum nobis praesentium perferendis voluptatum laborum error explicabo eius quos, fuga deserunt consectetur eos ex, consequuntur perspiciatis cupiditate omnis? Dolorum, hic magnam ipsam delectus quos similique odit officiis sed perspiciatis, doloribus sequi accusantium! Culpa numquam et neque impedit doloribus at sapiente magnam accusantium consectetur sint, ratione veritatis cumque molestias mollitia a atque laborum? Non praesentium voluptate vero minus nisi alias aspernatur quibusdam, cum laborum accusamus magnam pariatur harum?',
            'role' => 'admin',
            'password' => bcrypt('123456789'),
        ]);
    }
}
