<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Products\Item;


class PaymentsTableSeeder extends Seeder {

    public function run()
    {
        Payment::truncate();
        Transaction::truncate();

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

        $transaction = Transaction::create([
            'amount_subtotal' => '11.00',
            'amount_shipping' => '6.96',
            'amount_shipping_real' => '5.00',
            'amount_total' => '17.95',
            'amount_currency' => 'USD',
            'description' => 'Your BrushPoint Order',
        ]);

        $item = Item::where('sku', '=', 'RH-DMMED')->first();
        $soldItem = SoldItem::create([
            'name' => $item->name,
            'price' => $item->price,
            'currency' => 'USD',
            'quantity' => 2
        ]);

        $transaction->soldItems()->save($soldItem);


        $payment->transactions()->save($transaction);
    }

}