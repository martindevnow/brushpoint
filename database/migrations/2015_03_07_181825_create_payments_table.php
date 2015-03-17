<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('unique_id');
            $table->string('payment_id');
            $table->string('hash');

            $table->string('state');
            $table->string('intent');

            // Has Many Transactions (Many to Many??)
            // $table->integer('transaction_id')->nullable();
            $table->integer('payer_id')->nullable();
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
        Schema::drop('payments');
    }

}
