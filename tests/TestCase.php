<?php

use Illuminate\Support\Facades\Artisan;
use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;
use Martin\Products\Item;
use Martin\Users\User;


class TestCase extends IntegrationTest {

	/**
	 * Creates the application.
	 *
	 * @return \Illuminate\Foundation\Application
	 */
	public function createApplication()
	{
        putenv('DB_DEFAULT=mysql_test');
        putenv('TESTING=true');

		$app = require __DIR__.'/../bootstrap/app.php';

		$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

		return $app;
	}

    public function setUp()
    {
        parent::setUp();
        //Artisan::call('migrate');
        //Artisan::call('db:seed');
    }

    public function tearDown()
    {
        //Artisan::call('migrate:reset');
        parent::tearDown();
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


    /**
     * @param array $data
     * @return \Martin\Products\Item
     */
    public function createItem(array $data)
    {
        $item = Item::create($data);
        $item->save();
        return $item;
    }

    /**
     * @param Item $item
     * @param $quantity
     * @param $lot_code
     * @param string $status
     * @return \Martin\Products\Inventory
     */
    public function createInventory(Item $item, $quantity = 10, $lot_code = "10/15", $status = 'available')
    {
        $inventory = $item->addInventory([
            'lot_code' => $lot_code,
            'quantity' => $quantity,
            'original_quantity' => $quantity,
            'status' => $status
        ]);
        return $inventory;
    }

    /**
     *
     * @param Item $item
     * @return \Illuminate\Support\Collection|null|static
     */
    public function refreshItem(Item $item)
    {
        return $item->find($item->id);
    }



    public function createAdmin($email = 'ben@me.com', $password = "123456", $name = "ben")
    {
        $user = new User([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)

        ]);
        $user->save();
        return $user;
    }



}
