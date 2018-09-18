<?php

$factory->define(App\Trailscertificate::class, function (Faker\Generator $faker) {
    return [
        "order" => $faker->randomNumber(2),
        "title" => $faker->name,
        "slug" => $faker->name,
    ];
});
