<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('unique_id')->index();

            $table->integer('cartable_id');
            $table->string('cartable_type');

            $table->double('price', 6, 2);
            $table->integer('quantity');
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
        Schema::drop('carts');
    }

}
