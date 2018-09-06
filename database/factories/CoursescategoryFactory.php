<?php

$factory->define(App\Coursescategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
