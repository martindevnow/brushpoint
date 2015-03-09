<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('description');
            $table->string('name');
            $table->string('company');

            $table->string('street_1');
            $table->string('street_2');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('country');

            // extras
            $table->string('phone')->nullable();
            $table->string('buzzer')->nullable();

            // polymorphic relations
            $table->integer('addressable_id');
            $table->string('addressable_type');
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
        Schema::drop('addresses');
    }

}
