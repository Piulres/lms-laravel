<?php

$factory->define(App\Trail::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
