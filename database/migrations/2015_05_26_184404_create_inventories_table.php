<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inventories', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('transaction_id')->nullable();
            $table->integer('item_id')->nullable();

            $table->string('lot_code')->nullable();
            $table->timestamp('expiry_date')->nullable();

            $table->integer('quantity')->nullable();
            $table->integer('original_quantity')->nullable();

            $table->string('description')->default('sale');
            $table->string('status')->default('available');

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
		Schema::drop('inventories');
	}

}
