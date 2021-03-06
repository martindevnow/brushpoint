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

            $table->string('description')->nullable();
            $table->string('name');
            $table->string('company')->nullable();

            $table->string('street_1');
            $table->string('street_2')->nullable();
            $table->string('city');
            $table->string('province');
            $table->string('postal_code');
            $table->string('country');

            // extras
            $table->string('phone')->nullable();
            $table->string('buzzer')->nullable();

            $table->string('ppid')->nullable();
            $table->string('recipient_name')->nullable();
            $table->boolean('default_address')->default(false);

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
