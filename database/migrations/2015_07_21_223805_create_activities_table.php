<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('activities', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('subject_id')->index();
            $table->string('subject_type')->index();
            $table->string('name');
            $table->integer('user_id');
            $table->string('ip_address', 32);

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
        Schema::drop('activities');
	}

}
