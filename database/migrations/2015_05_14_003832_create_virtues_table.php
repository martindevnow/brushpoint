<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVirtuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('virtues', function(Blueprint $table)
		{
			$table->increments('id');
            $table->text('body');
            $table->enum('type', [
                'feature',
                'benefit',
                'other'
            ]);
            $table->integer('product_id');
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
		Schema::drop('virtues');
	}

}
