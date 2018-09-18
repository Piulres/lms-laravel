<?php

$factory->define(App\ContentPage::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "page_text" => $faker->name,
        "excerpt" => $faker->name,
    ];
});
