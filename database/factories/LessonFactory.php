<?php

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        "order" => $faker->randomNumber(2),
        "title" => $faker->name,
        "slug" => $faker->name,
        "introduction" => $faker->name,
        "content" => $faker->name,
    ];
});
