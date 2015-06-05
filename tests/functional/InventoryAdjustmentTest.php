<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
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

        // dd($oldestInventory);
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
        $payment = new Payment([
            'unique_id' => 'HIHDWJKFEWK',
            'payment_id' => 'jskegesgsd',
            'hash' => 'y34kl43htlk4h43htyoi4hyio43j',
            'state' => 'completed',
            'intent' => 'sale',
            'shipped' => 0,
        ]);

        $payer = new Payer([
            'payment_method' => 'PayPal',
            'status' => 'verified',
            'email' => 'the.one.martin@gmail.com',
            'first_name' => 'Ben',
            'last_name' => 'Martin',
        ]);

        $payer->payments()->save($payment);

        $this->assertEquals($payment, $payer->payments->first());



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
}
