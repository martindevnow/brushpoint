<?php


$factory('Martin\Products\Product', [
    'name' => $faker->word,
    'description' => $faker->sentences,
    'sku' => $faker->word,
    'price' => 5.00,
    'on_hand' => $faker->numberBetween(100,500),
    'heading' => $faker->sentence,
    'active' => 1,
    'portfolio' => 1,
    'purchase' => 0,
]);


$factory('Martin\Users\User', [
    'name' => $faker->name,
    'email' => $faker->email,
    'password' => bcrypt(12345),
]);

