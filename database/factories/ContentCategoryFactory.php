<?php

$factory->define(App\ContentCategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "slug" => $faker->name,
    ];
});
