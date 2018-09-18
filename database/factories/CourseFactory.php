<?php

$factory->define(App\Course::class, function (Faker\Generator $faker) {
    return [
        "order" => $faker->randomNumber(2),
        "title" => $faker->name,
        "slug" => $faker->name,
        "description" => $faker->name,
        "introduction" => $faker->name,
        "duration" => $faker->randomNumber(2),
        "start_date" => $faker->date("d/m/Y", $max = 'now'),
        "end_date" => $faker->date("d/m/Y", $max = 'now'),
        "approved" => 0,
    ];
});
