<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('slug');
			$table->timestamps();
		});


        Schema::create('category_product', function(Blueprint $table)
        {
            $table->integer('category_id')->unsigned();

            $table->integer('product_id')->unsigned();

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
		Schema::drop('categories');
		Schema::drop('category_product');
	}

}
