<?php

$factory->define(App\InternalNotification::class, function (Faker\Generator $faker) {
    return [
        "text" => $faker->name,
        "link" => $faker->name,
    ];
});
