<?php

$factory->define(App\Datalesson::class, function (Faker\Generator $faker) {
    return [
        "view" => $faker->randomNumber(2),
        "progress" => $faker->randomNumber(2),
        "user_id" => factory('App\User')->create(),
        "course_id" => factory('App\Course')->create(),
        "lesson_id" => factory('App\Lesson')->create(),
    ];
});
