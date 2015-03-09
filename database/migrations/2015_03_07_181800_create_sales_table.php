<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('payer_id');
            $table->string('session_id');
            $table->enum('stage', [
                'confirm_cart', // signed in
                'confirm_address',
                'confirm_shipping_method',
                'confirm_total_price',
                'confirm_payment',
                'payment_complete'
            ]);

            $table->double('cost_subtotal');

            $table->integer('address_id');
            $table->double('cost_shipping', 6, 2);
            $table->string('shipping_method');

            $table->double('cost_tax');

            $table->double('cost_total', 6, 2);

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
        Schema::drop('sales');
    }

}
