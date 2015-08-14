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
        $productToPurchase = "Dual Zone Replacement Heads";
        $productCost = "($5.00)";

        $this->updateCartShippingCountry()
            ->see($productCost);
	}

    /** @test */
    public function it_updates_cart_quantity()
    {
        $this->addItemToCart()
            ->submitForm('Update Quantities', ['15-quantity' => '2'])
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
