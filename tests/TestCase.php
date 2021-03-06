<?php

use Illuminate\Support\Facades\Artisan;
use Laracasts\Integrated\Extensions\Laravel as IntegrationTest;
use Martin\Ecom\Payment;
use Martin\Ecom\Transaction;
use Martin\Products\Item;
use Martin\Products\Product;
use Martin\Users\User;


class TestCase extends IntegrationTest {

    use \Laracasts\Integrated\Services\Laravel\DatabaseTransactions;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_DEFAULT=mysql_test');
        putenv('TESTING=true');

        $app = require __DIR__ . '/../bootstrap/app.php';

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




    public function createProductItemInventory()
    {
        $item = $this->createSpecificItem();
        $product = $this->createProductFromItem($item);
        $inventory = $this->createInventory($item);

        return compact('product', 'item', 'inventory');
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

    public function createSpecificItem()
    {
        $item = $this->createItem([
            'name'        => 'Toothbrush',
            'description' => 'This toothbrush is awesome.',
            'sku'         => 'TB-BEST-SOFT',
            'price'       => '5.50',
            'on_hand'     => '0',
            'variance'    => 'Soft'
        ]);

        return $item;
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


    /**
     * @param array $data
     * @return \Martin\Products\Item
     */
    public function createItemForProduct(array $data, Product $product)
    {
        $item = Item::create($data);
        $product->items()->save($item);
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
     * @param array $data
     * @return \Martin\Products\Item
     */
    public function createProduct(array $data)
    {
        $item = Product::create($data);
        $item->save();

        return $item;
    }


    public function createSpecificProduct()
    {
        $item = $this->createProduct([
            'name'        => 'Toothbrush',
            'description' => 'This toothbrush is awesome.',
            'sku'         => 'TB-BEST-SOFT',
            'price'       => '5.50',
            'on_hand'     => '0',
        ]);

        return $item;
    }

    /**
     *
     * @param Product $product
     * @return \Illuminate\Support\Collection|null|static
     */
    public function refreshProduct(Product $product)
    {
        return $product->find($product->id);
    }


    public function createProductFromItem(Item $item)
    {
        $itemData = $item->toArray();
        $product = $this->createProduct($itemData);
        $product->items()->save($item);
        return $product;
    }



    public function createAdmin($email = 'ben@me.com', $password = "123456", $name = "ben")
    {
        $user = new User([
            'name'     => $name,
            'email'    => $email,
            'password' => bcrypt($password)

        ]);
        $user->save();
        return $user;
    }


    public function createPayment(array $data = [])
    {
        $payment = \Laracasts\TestDummy\Factory::times(1)->create(Payment::class);
        $payment->address->addressable_type = get_class($payment->payer);
        $payment->address->addressable_id = $payment->payer->id;
        $payment->address->save();
        $payment->save();

        return $payment;
    }



    public function createTransaction($item, $quantity)
    {
        $transaction = new Transaction([
            'amount_subtotal' => $item->price * $quantity,
            'amount_shipping' => 5,
            'amount_total'    => $item->price * $quantity + 5,
            'amount_currency' => 'USD',
            'description'     => "Your BrushPoint Purchase",
        ]);
        $transaction->save();

        return $transaction;
    }

    public function createSoldItem(Item $item, $quantity)
    {
        $soldItem = new \Martin\Ecom\SoldItem([
            'name'     => $item->name,
            'price'    => $item->price,
            'currency' => "USD",
            'quantity' => $quantity,
            'sku'      => $item->sku,
            'intent'   => 'sale',
        ]);

        $item->soldItems()->save($soldItem);

        return $soldItem;
    }







    public function purchaseItem(Payment $payment, Item $item, $quantity = 1)
    {
        $transaction = $this->createTransaction($item, $quantity);
        $transaction->save();

        $soldItem = $this->createSoldItem($item, $quantity);
        $transaction->soldItems()->save($soldItem);

        $payment->transactions()->attach($transaction);
        $payment->save();

        return $payment;
    }








    /*
     * Integrated Testing Helper Functions
     */

    public function loginUser(User $user, $password = '123456')
    {
        $userData = $user->toArray();

        $this->visit('/admins')
            ->type($userData['email'], 'email')
            ->type($password, 'password')
            ->press('Login')
            ->andSee('BrushPoint Administration')
            ->onPage('/admins');
    }
}
