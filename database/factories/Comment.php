<?php

use Faker\Generator as Faker;

$factory->define(App\Comments::class, function (Faker $faker) {
    return [
        'username' => $faker->name,
        'comment' => str_random(100),
        'movie_id' => '1'
    ];
});

