<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Address;
use Martin\Ecom\Payer;

class PayerTableSeeder extends Seeder {

    public function run()
    {
        Payer::truncate();

        $faker = Faker::create();

        $payer = Payer::create([
            'payer_id' => "P69HMJQPKX258",
            'payment_method' => "paypal",
            'status' => "VERIFIED",
            'email' => $faker->email,
            'first_name' => $faker->word,
            'last_name' => ucfirst($faker->word),
        ]);



    }

}