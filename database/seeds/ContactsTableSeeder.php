<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Quality\Contact;
use Martin\Quality\Feedback;

class ContactsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('contacts')->truncate();

        $faker = Faker::create();

        foreach(range(1,5) as $index)
        {
            Contact::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'message' => ucfirst($faker->paragraph()),
                'hash' => bcrypt(time() . $index),
            ]);
        }
    }

}