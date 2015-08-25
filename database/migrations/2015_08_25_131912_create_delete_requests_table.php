<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeleteRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trash', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id');

            $table->string('reason');

            $table->string('trashable_type');
            $table->integer('trashable_id');

            $table->softDeletes();

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
		Schema::drop('trash');
	}

}
