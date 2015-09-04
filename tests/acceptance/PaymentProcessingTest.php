<?php
use Laracasts\Integrated\Extensions\Selenium;

class PaymentProcessingTest extends Selenium {


    public function setUp()
    {
        // $this->setBrowser('firefox');
        $this->baseUrl = 'http://bpl5.dev';

    }


    /**  */
    public function it_visits_the_cart()
    {
        // $this->setBrowserUrl('http://bpl5.dev/');
        $this->visit('/cart');
    }
}