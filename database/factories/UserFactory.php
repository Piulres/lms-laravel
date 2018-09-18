<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "lastname" => $faker->name,
        "website" => $faker->name,
        "email" => $faker->safeEmail,
        "password" => str_random(10),
        "remember_token" => $faker->name,
        "team_id" => factory('App\Team')->create(),
        "approved" => 0,
    ];
});
