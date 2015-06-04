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
            'payer_id' => "P69HMJQPKK999",
            'payment_method' => "paypal",
            'status' => "VERIFIED",
            'email' => "the.one.martin@gmail.com",
            'first_name' => "Ben",
            'last_name' => "Martin",
        ]);



    }

}