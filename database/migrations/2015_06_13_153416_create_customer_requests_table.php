<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_requests', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('feedback_id');
            $table->integer('contact_id');
            $table->integer('user_id');

            $table->string('hash');

            $table->string('brush_type');

            // request_lot_code
            // request_address
            // request_field_sample
            // request_image

            $table->boolean('request_lot_code');
            $table->boolean('request_address');
            $table->boolean('request_field_sample');
            $table->boolean('request_image');

            $table->timestamp('sent_at');

            $table->timestamp('received_at');

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
		Schema::drop('customer_requests');
	}

}
