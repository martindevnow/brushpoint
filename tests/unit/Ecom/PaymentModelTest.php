<?php
/**
 * User: benjaminm
 * Date: 19/08/2015
 * Time: 5:19 PM
 */

class PaymentModelTest extends TestCase {

    /** @test */
    public function it_creates_an_item()
    {
        $item = $this->createSpecificItem();
        $this->assertEquals(Martin\Products\Item::class, get_class($item));
    }

}