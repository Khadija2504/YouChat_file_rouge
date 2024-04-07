<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;

class categories extends Seeder
{
    public function run()
    {
        $categories = [
            'Plage',
            'Montagne',
            'Rivière',
            'Monument',
            'Ville',
            'Désert',
            'Forêt',
            'Camping',
            'Culture',
            'Aventure',
            'Gastronomie',
            'Histoire',
            'Relaxation',
            'Sport',
            'Spiritualité'
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}

