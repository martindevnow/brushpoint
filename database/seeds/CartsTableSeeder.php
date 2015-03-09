<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Products\Product;
use Martin\Users\User;
use Martin\Products\Cart;

class CartsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $users = User::lists('id');
        $products = Product::lists('id', 'price');


        foreach(range(1,100) as $index)
        {
            $products = Product::lists('id');
            $prices = Product::lists('price');
            $names = Product::lists('name');


            $product = $faker->randomElement($products);


            Cart::create([
                'user_id' => $faker->randomElement($users),
                'unique_id' => md5($faker->sentence()),
                'cartable_id' => $product,
                'cartable_type' => 'Martin\Products\Product',
                'price' => $prices[$product - 1],
                // 'name' => $names[$product - 1],

                'quantity' => $faker->numberBetween(1,4),
            ]);
        }
    }

}