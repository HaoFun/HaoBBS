<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    //隨機取一個月內時間
    $updated_at = $faker->dateTimeThisMonth();
    //隨機取一個月內時間並小於$updated_at
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'title'       => $faker->realText(10),
        'body'        => $faker->realText(200),
        'excerpt'     => $faker->realText(50),
        'created_at'  => $created_at,
        'updated_at'  => $updated_at
    ];
});
