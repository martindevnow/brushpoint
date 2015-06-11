<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Quality\Contact;
use Martin\Quality\Feedback;

class ContactsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('contacts')->truncate();

    }

}