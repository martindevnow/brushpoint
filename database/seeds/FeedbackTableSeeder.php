<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Products\Feedback;

class FeedbackTableSeeder extends Seeder {

    public function run()
    {
        DB::table('feedbacks')->delete();

        $faker = Faker::create();

        foreach(range(1,100) as $index)
        {
            Feedback::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'retailer' => ucfirst($faker->word),
                'lot_code' => $faker->word,
                'issue' => $faker->sentence() . " " . $faker->sentence(),
                'resolved' => false,
            ]);
        }
    }

}