<?php

$factory->define(App\Datatrail::class, function (Faker\Generator $faker) {
    return [
        "trail_id" => factory('App\Trail')->create(),
        "user_id" => factory('App\User')->create(),
        "view" => 0,
        "progress" => $faker->randomNumber(2),
        "rating" => $faker->randomNumber(2),
    ];
});
