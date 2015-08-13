<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttentionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attentions', function(Blueprint $table)
		{
			$table->increments('id');

            $table->boolean('global')->default(false);
            $table->integer('receiver_id')->nullable();

            $table->string('action')->nullable();

            // polymorphic relations
            $table->integer('attentionable_id')->nullable();
            $table->string('attentionable_type')->nullable();

            $table->boolean('seen')->default(false);
            $table->timestamp('seen_at');
            $table->integer('seen_by')->nullable();

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
		Schema::drop('attentions');
	}

}
