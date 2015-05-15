<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Users\User;

class PaymentProcessTest extends TestCase {

    use DatabaseTransactions;


    /** @test */
	public function it_adds_a_product_to_the_cart()
	{
        $productToPurchase = "Dual Zone Replacement Heads - (4 Pack)";
        $productCost = "($5.00)";

        $this->addItemToCart()

            ->onPage('cart')
            ->see($productCost)

            ->see('Select Country to Checkout')
            ->select('country_code', "CA")
            ->press('Update Country')

            ->onPage('cart')
            ->see('Change Country');
	}

    /** @test */
    public function it_updates_cart_quantity()
    {

        $this->addItemToCart()
            ->submitForm('Update Quantities', ['16-quantity' => '2'])
        ->onPage('cart')
        ->see("Quantities have been updated");


    }

    public function addItemToCart()
    {
        $productToPurchase = "Dual Zone Replacement Heads - (4 Pack)";
        $productCost = "($5.00)";
        $product['id'] = 17;

        return $this->visit('/purchase')
            ->see('Cart ($0.00')
            ->see($productToPurchase)
            ->click('View Details')

            ->onPage('purchase/id-17')
            ->see($productToPurchase)
            ->press('Add to Cart');
    }
}
