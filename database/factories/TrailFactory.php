<?php

$factory->define(App\Trail::class, function (Faker\Generator $faker) {
    return [
        "order" => $faker->name,
        "title" => $faker->name,
        "slug" => $faker->name,
        "description" => $faker->name,
        "introduction" => $faker->name,
        "featured_image" => $faker->name,
        "start_date" => $faker->date("d/m/Y", $max = 'now'),
        "end_date" => $faker->date("d/m/Y", $max = 'now'),
        "approved" => 0,
    ];
});
