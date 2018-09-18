<?php

$factory->define(App\General::class, function (Faker\Generator $faker) {
    return [
        "site_name" => $faker->name,
        "theme_color" => collect(["red","pink","purple","deep-purple","indigo","blue","light-blue","cyan","teal","green","light-green","lime","yellow","amber","orange","deep-orange","brown","grey","blue-grey",])->random(),
    ];
});
