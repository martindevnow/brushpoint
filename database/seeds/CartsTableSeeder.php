<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Products\Item;
use Martin\Products\Product;
use Martin\Users\User;
use Martin\Products\Cart;

class CartsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('carts')->truncate();

        $faker = Faker::create();
        $users = User::lists('id');

        foreach(range(1,10) as $index)
        {
            $items = Item::lists('id');
            $prices = Item::lists('price');

            $item = $faker->randomElement($items);

            Cart::create([
                'user_id' => $faker->randomElement($users),
                'unique_id' => md5($faker->sentence()),
                'item_id' => $item,
                'price' => $prices[$item - 1],
                'quantity' => $faker->numberBetween(1,4),
            ]);
        }
    }

}