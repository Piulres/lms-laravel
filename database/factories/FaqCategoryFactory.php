<?php

$factory->define(App\FaqCategory::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
