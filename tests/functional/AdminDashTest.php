<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Users\User;

class AdminDashTest extends TestCase {

    use DatabaseTransactions;


    /** @test */
	public function it_doesnt_allow_guests()
	{
        $data = ['name' => 'Dual Motion Heads'];
        TestDummy::create('Martin\Products\Product', $data
            );

        $this->visit('/admins')
            ->andSee('Login');

        $this->visit('/admins/products')
            ->andSee('Login');
	}

    /**  NEED TO UPDATE THIS TEST */
    public function it_allows_user_to_log_in()
    {
        $password = 'cira';
        $userData = [
            'email' => 'paulc@brushpoint.com',
            'password' => bcrypt($password)
        ];

        TestDummy::create('Martin\Users\User', $userData);
        $user = User::where('email', '=', $userData['email'])->first();

        $this->visit('/admins')
            ->type($userData['email'], 'email')
            ->type($password, 'password')
            ->press('Login')
            ->andSee('BrushPoint Administration')
            ->onPage('/admins');
    }



    /*
    public function test_it_adds_a_package()
    {
        // Option 1:
        $tracking_number = '128912491111';
        $this->visit('packages/create')
            ->type($tracking_number, 'tracking_number')
            ->press('Add Package')
            ->verifyInDatabase('packages', ['tracking_number' => $tracking_number])
            ->see($tracking_number)
            ->onPage('packages');

        // Option 2:
        $post = TestDummy::attributesFor('App\Package');

        $this->visit('packages/create')
            ->submitForm('Add Package', $post)
            ->verifyInDatabase('packages', ['tracking_number' => $tracking_number])
            ->see($tracking_number)
            ->onPage('packages');
    }*/


}
