<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');  // reference to the logged user
            $table->integer('sale_id');     // reference to the sale being made
            $table->integer('item_id');     // reference to the item purchased
            $table->double('price', 6, 2);  // store price incase of price changes
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
        Schema::drop('purchases');
    }

}
