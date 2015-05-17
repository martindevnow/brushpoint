<?php
use Laracasts\Integrated\Extensions\Selenium;

class PaymentProcessingTest extends Selenium {

    /** @test */
    public function it_visits_the_cart()
    {
        $this->setBrowserUrl('http://bpl5.dev/');
        $this->visit('/cart')
            ->wait(5000);
    }
}