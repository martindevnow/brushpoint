<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
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
        Address::truncate();
        DB::table('payment_transaction')->truncate();
        SoldItem::truncate();

        $faker = Faker::create();

        // Get the Payer
        $payer = Payer::find(1);

        // Set the payment
        $payment = Payment::create([
            'unique_id' => 'beta64jkesgjsioegse',
            'payment_id' => 'PAY-HIOHI42HI2',
            'hash' => md5('PAY-HIOHI42HI2'),
            'state' => 'created',
            'intent' => 'sale',
        ]);
        $payer->payments()->save($payment);

        // Set the Transaction
        $transaction = Transaction::create([
            'amount_subtotal' => '11.00',
            'amount_shipping' => '6.95',
            'amount_shipping_real' => '5.00',
            'amount_total' => '17.95',
            'amount_currency' => 'USD',
            'description' => 'Your BrushPoint Order',
        ]);

        // Set the Items
        $item = Item::where('sku', '=', 'RH-DM-MED')->first();
        $soldItem = SoldItem::create([
            'name' => $item->name,
            'price' => $item->price,
            'sku' => $item->sku,
            'item_id' => $item->id,
            'currency' => 'USD',
            'quantity' => 2
        ]);
        $transaction->soldItems()->save($soldItem);

        // Associate the Transaction to the Payment
        $payment->transactions()->save($transaction);



        // Set the Address
        $address = Address::create(
        [
            'name' => 'Ben Martin',
            'street_1' => $faker->streetAddress,
            'city' => $faker->city,
            'province' => $faker->word,
            'postal_code' => $faker->postcode,
            'country' => $faker->countryCode,
        ]);

        $address->payments()->save($payment);

        $payment->payer->addresses()->save($address);
    }

}