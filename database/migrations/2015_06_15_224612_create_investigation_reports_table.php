<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestigationReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('investigation_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('investigation_id');
			$table->integer('user_id');
			$table->string('file_name');
			$table->string('file_extension');
			$table->string('short_description');
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
		Schema::drop('investigation_reports');
	}

}
