<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Profession::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2)
    ];
});
