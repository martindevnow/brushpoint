<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Quality\Feedback;

class FeedbackTableSeeder extends Seeder {

    public function run()
    {
        DB::table('feedbacks')->truncate();

        $faker = Faker::create();

        foreach(range(1,5) as $index)
        {
            Feedback::create([
                'name' => $faker->name,
                'email' => "the.one.martin+" . $faker->word . "@gomail.com",
                'phone' => $faker->phoneNumber,
                'retailer_text' => ucfirst($faker->word),
                'lot_code' => $faker->word,
                'hash' => bcrypt($faker->phoneNumber),
                'issue_text' => $faker->sentence() . " " . $faker->sentence(),
            ]);
        }
    }

}