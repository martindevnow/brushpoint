<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();


        $testing = env('TESTING', false);


        $env = env('APP_ENV');

        if ($env == "local" && ! $testing )
        {
            $this->call('UsersTableSeeder');
            $this->call('ProductsTableSeeder');
            $this->call('PurchaseTableSeeder');
            $this->call('CartsTableSeeder');
            $this->call('FeedbackTableSeeder');
            $this->call('PayerTableSeeder');
            $this->call('PaymentsTableSeeder');
            $this->call('ContactsTableSeeder');
            $this->call('InventoriesTableSeeder');
            $this->call('IssuesTableSeeder');
            $this->call('RetailersTableSeeder');
        }
        else
        {
            $this->call('UsersTableSeeder');
            $this->call('ProductsTableSeeder');
            $this->call('PurchaseTableSeeder');
        }
	}
}
