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

		$this->call('UsersTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('PurchaseTableSeeder');
		$this->call('CartsTableSeeder');
        $this->call('FeedbackTableSeeder');
        $this->call('PayerTableSeeder');
        $this->call('PaymentsTableSeeder');
        $this->call('ContactsTableSeeder');

	}

}
