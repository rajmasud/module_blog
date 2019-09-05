<?php

use Faker\Generator as Faker;
//---- models ----
use Modules\Blog\Models\Article;
use Modules\LU\Models\User;

$factory->define(Article::class, function (Faker $faker) {
    return [
        //'title' => $faker->sentence,
        //'description' => $faker->paragraph,
       //'auth_user_id' => factory(User::class)->create()->auth_user_id,
        /*
    	'latitude' 			=> $faker->latitude,
        'longitude' 		=> $faker->longitude,
        'route'				=> $faker->streetName,
        'country' 			=> $faker->country,
        'street_number'		=> $faker->buildingNumber,
        'postal_code'		=> $faker->postcode,
        'locality' 			=> $faker->city,
        'formatted_address' => $faker->streetAddress,
        */
    ];
});
