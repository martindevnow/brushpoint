<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Users\User;

class InventoryAdjustmentTest extends TestCase {

    use DatabaseTransactions;










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
