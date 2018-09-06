<?php

$factory->define(App\Lesson::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "introduction" => $faker->name,
        "content" => $faker->name,
    ];
});
