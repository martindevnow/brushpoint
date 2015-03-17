<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');

            $table->decimal('amount_subtotal');
			$table->decimal('amount_shipping');
			$table->decimal('amount_shipping_real');
            $table->decimal('amount_total');
			$table->string('amount_currency');
			$table->string('description');

            // has many items
            // $relationship on items table

			$table->timestamps();
		});


        Schema::create('payment_transaction', function(Blueprint $table)
		{
			$table->integer('transaction_id')->unsigned()->index();
			$table->integer('payment_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
		Schema::drop('payment_transaction');
	}

}
