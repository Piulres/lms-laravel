<?php

$factory->define(App\Trailscategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
