<?php

use Faker\Generator as Faker;

$factory->define(App\Teacher::class, function (Faker $faker) {
    return [
        //
        'user_id'=>null,
        'title'=>$faker->jobTitle,
        'bigraphy'=>$faker->paragraph,
        'website_url'=>$faker->url,

    ];
});
