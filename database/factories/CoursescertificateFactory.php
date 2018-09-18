<?php

$factory->define(App\Coursescertificate::class, function (Faker\Generator $faker) {
    return [
        "order" => $faker->randomNumber(2),
        "title" => $faker->name,
        "slug" => $faker->name,
    ];
});
