<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Users\User;

class PaymentProcessTest extends TestCase {

    use DatabaseTransactions;


    /** @test */
	public function it_updates_country()
	{
        $this->updateCartShippingCountry();
	}

    /** @test */
    public function it_updates_cart_quantity()
    {
        $item = $this->createSpecificItem();

        $this->addItemToCart($item)
            ->submitForm('Update Quantities', [$item->id.'-quantity' => '2'])
            ->onPage('cart')
            ->see("Quantities have been updated");
    }


    /** @test */
    public function it_pays_through_paypal()
    {
        $this->updateCartShippingCountry()
            ->see("Change Country")
            ->see("Total:")
            //->click('Checkout');
        ;
    }




    public function addItemToCart($item)
    {
        $inventory = $this->createInventory($item);

        return $this->visit('/purchase')
            ->see('Cart ($0.00')
            ->see($item->name)
            ->click('View Details')

            ->onPage('purchase/id-'.$item->id)
            ->see($item->name)
            ->press('Add to Cart');
    }

    public function updateCartShippingCountry()
    {
        $item = $this->createSpecificItem();

        return $this->addItemToCart($item)
            ->onPage('cart')
            // ->see($productCost)

            ->see('Select Country to Checkout')
            ->select('country_code', "CA")
            ->press('Update Country')

            ->onPage('cart')
            ->see('Change Country');
    }
}
