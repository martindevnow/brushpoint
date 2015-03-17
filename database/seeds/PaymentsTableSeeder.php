<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;


class PaymentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('payments')->delete();
        DB::table('tranactions')->delete();


        // $faker = Faker::create();

        $payer = Payer::find(1);

        $payment = Payment::create([
            'unique_id' => 'beta64jkesgjsioegse',
            'payment_id' => 'PAY-HIOHI42HI2',
            'hash' => md5('PAY-HIOHI42HI2'),
            'state' => 'created',
            'intent' => 'sale',
        ]);

        $payer->payments()->save($payment);
    }

}