<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Reply::class, function (Faker $faker) {

    //隨機取一個月內時間
    $updated_at = $faker->dateTimeThisMonth();
    //隨機取一個月內時間並小於$updated_at
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'content'    => $faker->realText(20),
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
