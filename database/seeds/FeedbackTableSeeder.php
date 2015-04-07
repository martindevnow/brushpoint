<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Quality\Feedback;

class FeedbackTableSeeder extends Seeder {

    public function run()
    {
        DB::table('feedbacks')->truncate();

        $faker = Faker::create();

        foreach(range(1,10) as $index)
        {
            Feedback::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'retailer_text' => ucfirst($faker->word),
                'lot_code' => $faker->word,
                'issue_text' => $faker->sentence() . " " . $faker->sentence(),
            ]);
        }
    }

}