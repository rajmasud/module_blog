<?php

use Faker\Generator as Faker;
//---- models ----
use Modules\Blog\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'guid' => $faker->slug,
        'subtitle' => $faker->sentence,
        'txt' => $faker->paragraph,
        'lang' => app()->getLocale(),
        //'user_id' => factory('App\User')->create()->id,
    ];
});
