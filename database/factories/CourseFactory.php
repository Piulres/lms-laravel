<?php

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "description" => $faker->name,
        "introduction" => $faker->name,
        "duration" => $faker->randomNumber(2),
    ];
});
