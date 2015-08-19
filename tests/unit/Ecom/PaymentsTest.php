<?php

use App\Events\ProductWasPurchased;
use App\Events\TestProductWasPurchased;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Core\Address;
use Martin\Ecom\Payer;
use Martin\Ecom\Payment;
use Martin\Ecom\SoldItem;
use Martin\Ecom\Transaction;
use Martin\Products\Inventory;
use Martin\Products\Item;

class PaymentsTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
    public function it_creates_an_item()
    {
        $item = $this->createSpecificItem();
        $this->assertEquals(get_class($item), "Martin\\Products\\Item");
    }

    /** @test */
    public function it_creates_inventory()
    {
        $item = $this->createSpecificItem();

        $quantity = 1;
        $inventory = $this->createInventory($item, $quantity, '30/15', 'available');

        $this->assertEquals(get_class($inventory), "Martin\\Products\\Inventory");
        $this->assertEquals($item->name, $inventory->item->name);
        $this->assertEquals($inventory->sku, $item->inventories->first()->sku);

        $item = $this->refreshItem($item);
        $this->assertEquals($quantity, $inventory->item->on_hand);
    }


    /*
     * TESTS
     * -- INVENTORY TESTS INTEGRATED WITH PURCHASING
     */

    /** @test */
    public function it_purchases_a_product()
    {
        $quantity = 10;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, "10/15");


        $payment = $this->createPayment([]);
        $this->assertEquals(\Martin\Ecom\Payment::class, get_class($payment));

        $amountToBuy = 2;
        $payment = $this->purchaseItem($payment, $item, $amountToBuy);




        Event::fire((new TestProductWasPurchased($payment)));

        $purchasedItem = Item::find($payment->transactions->first()->soldItems->first()->item->id);
        $this->assertEquals($quantity - $amountToBuy, $purchasedItem->on_hand);
    }


    /** @test */
    public function it_makes_payer_from_payment()
    {
        $payment = $this->createPayment([]);
        $this->assertEquals(\Martin\Ecom\Payment::class, get_class($payment));

        $payer = $payment->payer;
        $this->assertEquals(\Martin\Ecom\Payer::class, get_class($payer));
    }


    /** @test */
    public function it_purchases_two_lot_codes()
    {
        $quantity = 2;
        $item = $this->createSpecificItem();
        $inventory = $this->createInventory($item, $quantity, '10/13');
        $inventory2 = $this->createInventory($item, $quantity, '42/15');

        $amountToBuy = 3;
        $payment = $this->createPayment([]);

        $this->purchaseItem($payment, $item, $amountToBuy);
        Event::fire((new TestProductWasPurchased($payment)));

        $item = $item->refreshOnHand();
        $this->assertEquals($quantity*2 - $amountToBuy, $item->on_hand);


        $inventory = $inventory->find($inventory->id);
        $inventory2 = $inventory2->find($inventory2->id);

        $this->assertEquals(0, $inventory->quantity);
        $this->assertEquals(1, $inventory2->quantity);
    }


    public function getItemBySku($sku)
    {
        return Item::where('sku', '=', $sku)->first();
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






    /*
     * NOT TESTS
     * -- INVENTORY HELPER FUNCTIONS
     */

    public function createSpecificItem()
    {
        $item = $this->createItem([
            'name' => 'Toothbrush',
            'description' => 'This toothbrush is awesome.',
            'sku' => 'TB-BEST-SOFT',
            'price' => '5.50',
            'on_hand' => '0',
            'variance' => 'Soft'
        ]);

        return $item;
    }





    /*
     * HELPER FUNCTIONS
     * -- PURCHASE/PAYMENT RELATED
     */

    public function createPayment(array $data = [])
    {
        $payment = \Laracasts\TestDummy\Factory::times(1)->create(Payment::class);
        $payment->address->addressable_type = get_class($payment->payer);
        $payment->address->addressable_id = $payment->payer->id;
        $payment->address->save();
        $payment->save();
        return $payment;
    }

    public function purchaseItem(Payment $payment, Item $item, $quantity = 1)
    {
        $transaction = $this->createTransaction($item, $quantity);
        $transaction->save();

        $soldItem = $this->createSoldItem($item, $quantity);
        $transaction->soldItems()->save($soldItem);

        $payment->transactions()->attach($transaction);
        $payment->save();
        return $payment;
    }

    public function createTransaction($item, $quantity)
    {
        $transaction = new Transaction([
            'amount_subtotal' => $item->price * $quantity,
            'amount_shipping' => 5,
            'amount_total' => $item->price* $quantity + 5,
            'amount_currency' => 'USD',
            'description' => "Your BrushPoint Purchase",
        ]);
        $transaction->save();
        return $transaction;
    }

    public function createSoldItem(Item $item, $quantity)
    {
        $soldItem = new \Martin\Ecom\SoldItem([
            'name' => $item->name,
            'price' => $item->price,
            'currency' => "USD",
            'quantity' => $quantity,
            'sku' => $item->sku,
            'intent' => 'sale',
        ]);

        $item->soldItems()->save($soldItem);
        return $soldItem;
    }


}
