<?php

$factory->define(App\FaqQuestion::class, function (Faker\Generator $faker) {
    return [
        "category_id" => factory('App\FaqCategory')->create(),
        "question_text" => $faker->name,
        "answer_text" => $faker->name,
    ];
});
