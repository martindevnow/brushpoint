<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payers', function(Blueprint $table)
        {
            $table->increments('id');
            // populate with paypal information
            $table->string('payment_method');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('ppid')->index(); // STRING set by PayPal


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
        Schema::drop('payers');
    }

}
