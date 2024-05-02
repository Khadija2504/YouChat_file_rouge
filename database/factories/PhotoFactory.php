<?php
use Faker\Generator as Faker;

$factory->define(App\Models\Photo::class, function (Faker $faker) {
    return [
        'photo' => 'photo_' . $faker->numberBetween(1, 10) . '.jpg', // Assuming you have 10 photo files named photo_1.jpg, photo_2.jpg, ..., photo_10.jpg
        'created_at' => now(),
        'updated_at' => now(),
    ];
});

