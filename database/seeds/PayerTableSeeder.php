<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Address;
use Martin\Ecom\Payer;

class PayerTableSeeder extends Seeder {

    public function run()
    {
        DB::table('payers')->delete();
        DB::table('addresses')->delete();


        $faker = Faker::create();

        $payer = Payer::create([
            'payer_id' => "P69HMJQPKX258",
            'payment_method' => "paypal",
            'status' => "VERIFIED",
            'email' => $faker->email,
            'first_name' => $faker->word,
            'last_name' => ucfirst($faker->word),
        ]);


        $payer->addresses()->create([
            'name' => 'Ben Martin',
            'street_1' => $faker->streetAddress,
            'city' => $faker->city,
            'province' => $faker->word,
            'postal_code' => $faker->postcode,
            'country' => $faker->countryCode,
        ]);

        $payer->addresses()->create([
            'name' => 'Atsuko Martin',
            'street_1' => $faker->streetAddress,
            'city' => $faker->city,
            'province' => $faker->word,
            'postal_code' => $faker->postcode,
            'country' => $faker->countryCode,
        ]);
    }

}