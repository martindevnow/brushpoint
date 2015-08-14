<?php

use Illuminate\Support\Facades\Log;
use Laracasts\Integrated\Services\Laravel\DatabaseTransactions;
use Laracasts\TestDummy\Factory as TestDummy;
use Martin\Users\User;

class PagesTest extends TestCase {

    use DatabaseTransactions;


    /** @test */
    public function it_visits_static_page()
    {
        $this->visit('/')
            ->andSee('We pride ourselves on quality products');

        $this->visit('/home')
            ->andSee('We pride ourselves on quality products');

        $this->visit('/about')
            ->andSee('About Us');

        $this->visit('/capabilities')
            ->andSee('Our Capabilities');

        $this->visit('/contact')
            ->andSee('Leave A Message');

        $this->visit('/video')
            ->andSee('Two Videos are available to watch, if watching from a mobile device your standard data plan rates would apply');

        $this->visit('/video.htm')
            ->andSee('Two Videos are available to watch, if watching from a mobile device your standard data plan rates would apply');
    }

    /** @test */
    public function it_visits_feedback()
    {
        $this->visit('/feedback')
            ->andSee('Leave A Message');

        $this->visit('/feedback/thankyou')
            ->andSee('We appreciate your feedback regarding our products.');
    }

    /** @test */
    public function it_visits_capabilities_page()
    {

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
