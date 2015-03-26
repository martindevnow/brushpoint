<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestigationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('investigations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('feedback_id');
            $table->timestamp('field_sample_requested_at');
            $table->timestamp('field_sample_received_at');
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
		Schema::drop('investigations');
	}

}
