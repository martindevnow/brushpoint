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
}
