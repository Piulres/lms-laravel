<?php

$factory->define(App\Coursetag::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "slug" => $faker->name,
    ];
});
