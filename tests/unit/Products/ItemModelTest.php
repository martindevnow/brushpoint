<?php

class ItemModelTest extends TestCase {

    /** @test */
    public function it_creates_an_item()
    {

        $item = $this->createSpecificItem();
        $this->assertEquals(Martin\Products\Item::class, get_class($item));
    }
}