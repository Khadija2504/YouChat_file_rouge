<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class cities extends Seeder
{
    public function run()
    {
        $moroccanCities = [
            'Marrakech',
            'Casablanca',
            'Fes',
            'Tangier',
            'Agadir',
            'Rabat',
            'Chefchaouen',
            'Essaouira',
            'Ouarzazate',
            'Meknes',
            'Asilah',
            'Tetouan',
            'Erfoud',
            'Oujda',
            'Fez',
        ];

        foreach ($moroccanCities as $city) {
            City::create([
                'name' => $city,
            ]);
        }
    }
}
