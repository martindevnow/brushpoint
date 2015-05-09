<?php

use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;

class ExampleTest extends TestCase {

    use DatabaseTransactions;

    /** @test */
	public function it_displays_all_products()
	{
        $data = ['name' => 'Dual Motion Heads'];
        TestDummy::create('Martin\Products\Product', $data
            );

        $this->visit('/products')
            ->verifyInDatabase('products', $data)
            ->andSee('Dual Motion Heads');
	}



}
