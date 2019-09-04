<?php

use Faker\Generator as Faker;
//---- models ----
use Modules\Blog\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        //'user_id' => factory('App\User')->create()->id,
    ];
});
