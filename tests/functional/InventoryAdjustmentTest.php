<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Products\Inventory;
use Martin\Products\Item;
use Martin\Users\User;

class InventoryAdjustmentTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
    public function it_purchases_a_product()
    {
        $item = $this->getItemBySku('RH-DM-SOFT');

        // it doesn't seem that this is persisting to the database...
        // $this->createDummyInventoryData($item);

        $activeInventory = $item->getActiveInventory();

        // should be 500 units of active inventory
        $this->assertTrue(( $activeInventory->total == 500));

        // oldest available SKU should be "10/14"
        $oldestInventory = $item->getOldestActiveInventory();

        $this->assertTrue($oldestInventory->lot_code == '10/14');

        // $this->makeNewPayment($item);
    }


    /** @test */
    public function it_makes_payer_from_payment()
    {
        $payment = TestDummy::create('Martin\Ecom\Payment');

        $this->assertEquals('Martin\Ecom\Payment', get_class($payment));

        $payer = $payment->payer;

        $this->assertEquals('Martin\Ecom\Payer', get_class($payer));

        $transactions = $payment->transactions;

        foreach ($transactions as $transaction)
        {
            $soldItems = $transaction->soldItems;
            foreach($soldItems as $soldItem)
            {
                dd($soldItem);
            }
        }

        event(new \App\Events\ProductWasPurchased($payment));
    }

    /** @test */
    public function it_works_backwards()
    {
        $soldItem = new SoldItem([
            'sku' => 'RH-DZ-MED',
        ]);
    }



    /** @test */
    public function it_adds_to_the_database()
    {
        /*$item = new Item([
            'prod'
        ])*/
    }


    /** @test */
    public function it_sets_up_payment_model()
    {
        $item = Item::where('sku', '=', 'RH-DZ-MED')->first();

        $payment = $this->setUpPaymentTransaction($item);




        $this->seeInDatabase('payments', ['unique_id' => 'UNIQUE_ID_THIS_IS_IT']);
        $this->assertEquals($payment, $payer->payments->first());

        $this->assertEquals($payment->address_id, $address->id);


        $invo = $item->getActiveInventory();
        $activeInvo = $invo->total;

        dd($activeInvo);


        /**
         * Taken from the AdjustPurchased Inventory Script
         */

        $transactions = $payment->transactions;

        foreach($transactions as $transaction)
        {
            $soldItems = $transaction->soldItems;
            foreach($soldItems as $soldItem)
            {
                // $lotInventory = Inventory::where('item_id', '=', $soldItem->item->id);

                $item = Item::find($soldItem->item->id);
                $item->on_hand = $item->on_hand - $soldItem->quantity;
                $item->save();

                $inventory = new Inventory();
                $inventory->description = "sale";
                $inventory->item_id = $soldItem->item->id;
                $inventory->quantity = $soldItem->quantity * -1;
                $inventory->transaction_id = $transaction->id;
                $inventory->save();
            }
        }



    }




    public function getItemBySku($sku)
    {
        return Item::where('sku', '=', $sku)->first();
    }


    public function createDummyInventoryData(Item $item)
    {
        Inventory::create([
            'description' => 'on_hold',
            'quantity' => '75',
            'lot_code' => '34/09',
            'expiry_date' => '2013',
            'item_id' => $item->id,
        ]);
        Inventory::create([
            'description' => 'available',
            'quantity' => '200',
            'lot_code' => '34/14',
            'expiry_date' => '2017',
            'item_id' => $item->id,
        ])->save();
        Inventory::create([
            'description' => 'available',
            'quantity' => '200',
            'lot_code' => '34/15',
            'expiry_date' => '2018',
            'item_id' => $item->id,
        ])->save();
    }





    public function addItemToCart()
    {
        $productToPurchase = "Dual Zone Replacement Heads";
        return $this->visit('/purchase')
            ->see('Cart ($0.00')
            ->see($productToPurchase)
            ->click('View Details')

            ->onPage('purchase/id-17')
            ->see($productToPurchase)
            ->press('Add to Cart');
    }

    public function updateCartShippingCountry()
    {
        return $this->addItemToCart()
            ->onPage('cart')
            // ->see($productCost)

            ->see('Select Country to Checkout')
            ->select('country_code', "CA")
            ->press('Update Country')

            ->onPage('cart')
            ->see('Change Country');
    }

    public function setUpPaymentTransaction(Item $item)
    {
        $payer = Payer::create([
            'payer_id' => 'PAYER_ID_THIS_IS_IT',
            'payment_method' => 'paypal',
            'status' => 'verified',
            'email' => 'the.one.martin@gmail.com',
            'first_name' => 'Mr. First',
            'last_name' => 'LastName',
        ]);

        $payer->payments()->save(Payment::create([
            'unique_id' => 'UNIQUE_ID_THIS_IS_IT',
            'payment_id' => 'PAYMENT_ID_HERE',
            'hash' => 'thisisthehashforthepaymenttable',
            'state' => 'completed',
            'intent' => 'sale',
            'shipped' => 0,
        ]));


        // add an address too.
        $address = Address::create([
            'description' => 'Address',
            'name' => 'Mr. First LastName',
            'company' => 'The Company',

            'street_1' => '123 Main Street.', 	// string
            'street_2' => '', 	                // string
            'city' => 'The Big City', 	        // string
            'province' => 'ON',                 // string
            'postal_code' => 'L2N 6C9',         // string
            'country' => 'CA',                  // string

            'phone' => '905-934-9625', 	        // string
        ]);


        // build transactions (with sold items)
        $transaction = Transaction::create([
            'amount_subtotal',
            'amount_shipping',
            'amount_shipping_real',
            'amount_total',
            'amount_currency',
            'description',
        ]);


        $transaction->soldItems()->save(SoldItem::create([
            'sku' => $item->sku,
            'name' => $item->name,
            'price' => $item->price,
            'currency' => 'USD',
            'quantity' => '1',
            'item_id' => $item->id,
        ]));


        $payment = Payment::where('unique_id', '=', 'UNIQUE_ID_THIS_IS_IT')->first();
        $payer = Payer::where('first_name', '=', 'Mr. First')->first();


        $payer->addresses()->save($address);
        $address->payments()->save($payment);
        $payment->transactions()->attach($transaction);


        return $payment;
    }
}
