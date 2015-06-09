<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            // has an address
            $table->string('retailer_text')->nullable();
            $table->integer('retailer_id')->nullable();
            $table->string('retailer_reference')->nullable();

            $table->string('lot_code')->nullable();
            $table->timestamp('lot_code_requested_at');

            $table->text('issue_text');
            $table->string('issue_id')->nullable()->index();

            $table->string('hash')->nullable();

            $table->string('intent');

            // Replaced by 'closed' field
            // $table->boolean('resolved')->default(false);

            // BACK END FOR QA
            $table->string('bp_code')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('country')->nullable();



            $table->integer('address_id')->nullable();
            $table->timestamp('address_requested_at');


            $table->boolean('adverse_event')->default(false);
            $table->boolean('health_canada_report')->default(false);
            $table->boolean('capa_required')->default(false);
            $table->string('capa_reason')->nullable();


            $table->boolean('closed')->default(false);
            $table->timestamp('closed_at');

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
        Schema::drop('feedbacks');
    }

}
