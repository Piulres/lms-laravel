<?php

$factory->define(App\Datacourse::class, function (Faker\Generator $faker) {
    return [
        "course_id" => factory('App\Course')->create(),
        "user_id" => factory('App\User')->create(),
        "view" => 0,
        "progress" => $faker->randomNumber(2),
        "rating" => $faker->randomNumber(2),
    ];
});
