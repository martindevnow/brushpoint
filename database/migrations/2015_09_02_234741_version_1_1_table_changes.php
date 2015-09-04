<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Version11TableChanges extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('inventories', function(Blueprint $table) {
            $table->boolean('counted')->default(false);
        });

        Schema::table('emails', function(Blueprint $table) {
            $table->dropColumn('subject');
            $table->dropColumn('body');
            $table->dropColumn('template');
            $table->dropColumn('recipient_email');
            $table->dropColumn('feedback_id');


            $table->string('email_type');
            $table->text('recipient_list');
        });

        Schema::table('feedbacks', function($table) {
            $table->timestamp('closed_at')->nullable()->change();
        });

        // DB::statement('ALTER TABLE `feedbacks` MODIFY `closed_at` timestamp NULL;');



	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('feedbacks', function(Blueprint $table) {
            $table->dropColumn('received_at');
        });

        Schema::table('inventories', function(Blueprint $table) {
            $table->dropColumn('counted');
        });

        Schema::table('emails', function(Blueprint $table) {
            $table->string('subject');
            $table->text('body');
            $table->string('template');
            $table->string('recipient_email');
            $table->integer('feedback_id');

            $table->dropColumn('email_type');
            $table->dropColumn('recipient_list');
        });

        // DB::statement('ALTER TABLE `feedbacks` MODIFY `closed_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\';');

    }
}
