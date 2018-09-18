<?php

$factory->define(App\Datatrail::class, function (Faker\Generator $faker) {
    return [
        "view" => $faker->randomNumber(2),
        "progress" => $faker->randomNumber(2),
        "rating" => $faker->randomNumber(2),
        "testimonal" => $faker->name,
        "user_id" => factory('App\User')->create(),
        "trail_id" => factory('App\Trail')->create(),
        "certificate_id" => factory('App\Trailscertificate')->create(),
    ];
});
