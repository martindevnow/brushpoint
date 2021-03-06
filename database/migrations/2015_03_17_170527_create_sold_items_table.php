<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoldItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sold_items', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('item_id')->nullable();
            $table->string('sku')->nullable();
            $table->string('lot_code');

            $table->integer('transaction_id')->nullable();

            $table->string('name');
            $table->decimal('price');
            $table->string('currency');
            $table->integer('quantity');

            $table->string('intent')->nullable();

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
		Schema::drop('sold_items');
	}

}
