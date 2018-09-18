<?php

$factory->define(App\Datacourse::class, function (Faker\Generator $faker) {
    return [
        "view" => $faker->randomNumber(2),
        "progress" => $faker->randomNumber(2),
        "rating" => $faker->randomNumber(2),
        "testimonal" => $faker->name,
        "user_id" => factory('App\User')->create(),
        "course_id" => factory('App\Course')->create(),
        "certificate_id" => factory('App\Coursescertificate')->create(),
    ];
});
