<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('sku');
            $table->double('price', 6, 2);
            $table->integer('on_hand');


            $table->string('img')->nullable();

            $table->string('heading')->nullable();

            $table->string('video_name')->nullable();
            $table->string('video_link')->nullable();

            //$table->text('benefits')->nullable();
            //$table->text('features')->nullable();

            $table->text('claim')->nullable();

            $table->string('patent_name')->nullable();
            $table->string('patent_link')->nullable();

            $table->boolean('map')->nullable();
            $table->text('map_info')->nullable();

            $table->text('other')->nullable();
            //$table->text('other_list')->nullable();

            $table->boolean('link_to_video')->nullable();

            $table->mediumInteger('spacer_height')->unsigned()->nullable();

            $table->boolean('active')->default(0);
            $table->boolean('portfolio')->default(0);
            $table->boolean('purchase')->default(0);

            $table->integer('user_id')->unsigned()->nullable();


            $table->smallInteger("display_order")->default(100);

            $table->integer('unit_weight_g')->nullable();
            $table->integer('inner_weight_g')->nullable();
            $table->integer('case_weight_g')->nullable();

            $table->decimal('unit_height_cm', 3,3)->nullable();
            $table->decimal('unit_width_cm', 3,3)->nullable();
            $table->decimal('unit_depth_cm', 3,3)->nullable();

            $table->decimal('inner_height_cm', 3,3)->nullable();
            $table->decimal('inner_width_cm', 3,3)->nullable();
            $table->decimal('inner_depth_cm', 3,3)->nullable();

            $table->decimal('case_height_cm', 3,3)->nullable();
            $table->decimal('case_width_cm', 3,3)->nullable();
            $table->decimal('case_depth_cm', 3,3)->nullable();


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
        Schema::drop('products');
    }

}
