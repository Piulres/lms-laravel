<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "last_name" => $faker->name,
        "email" => $faker->safeEmail,
        "website" => $faker->name,
        "password" => str_random(10),
        "remember_token" => $faker->name,
        "team_id" => factory('App\Team')->create(),
        "approved" => 0,
    ];
});
