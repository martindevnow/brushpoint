<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('users', function($table) {
            $table->softDeletes();
        });
        Schema::table('products', function($table) {
            $table->softDeletes();
        });
        Schema::table('carts', function($table) {
            $table->softDeletes();
        });
        Schema::table('items', function($table) {
            $table->softDeletes();
        });


        Schema::table('comments', function($table) {
            $table->softDeletes();
        });
        Schema::table('addresses', function($table) {
            $table->softDeletes();
        });
        Schema::table('payments', function($table) {
            $table->softDeletes();
        });
        Schema::table('payers', function($table) {
            $table->softDeletes();
        });


        Schema::table('notes', function($table) {
            $table->softDeletes();
        });
        Schema::table('feedbacks', function($table) {
            $table->softDeletes();
        });
        Schema::table('images', function($table) {
            $table->softDeletes();
        });
        Schema::table('retailers', function($table) {
            $table->softDeletes();
        });


        Schema::table('transactions', function($table) {
            $table->softDeletes();
        });
        Schema::table('sold_items', function($table) {
            $table->softDeletes();
        });
        Schema::table('issues', function($table) {
            $table->softDeletes();
        });
        Schema::table('investigations', function($table) {
            $table->softDeletes();
        });


        Schema::table('packages', function($table) {
            $table->softDeletes();
        });
        Schema::table('virtues', function($table) {
            $table->softDeletes();
        });
        Schema::table('inventories', function($table) {
            $table->softDeletes();
        });
        Schema::table('contacts', function($table) {
            $table->softDeletes();
        });


        Schema::table('emails', function($table) {
            $table->softDeletes();
        });
        Schema::table('customer_requests', function($table) {
            $table->softDeletes();
        });
        Schema::table('investigation_reports', function($table) {
            $table->softDeletes();
        });
        Schema::table('attachments', function($table) {
            $table->softDeletes();
        });


        Schema::table('activities', function($table) {
            $table->softDeletes();
        });
        Schema::table('attentions', function($table) {
            $table->softDeletes();
        });
        Schema::table('password_resets', function($table) {
            $table->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('products', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('carts', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('items', function($table) {
            $table->dropSoftDeletes();
        });


        Schema::table('comments', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('addresses', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('payments', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('payers', function($table) {
            $table->dropSoftDeletes();
        });


        Schema::table('notes', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('feedbacks', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('images', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('retailers', function($table) {
            $table->dropSoftDeletes();
        });


        Schema::table('transactions', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('sold_items', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('issues', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('investigations', function($table) {
            $table->dropSoftDeletes();
        });


        Schema::table('packages', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('virtues', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('inventories', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('contacts', function($table) {
            $table->dropSoftDeletes();
        });


        Schema::table('emails', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('customer_requests', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('investigation_reports', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('attachments', function($table) {
            $table->dropSoftDeletes();
        });


        Schema::table('activities', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('attentions', function($table) {
            $table->dropSoftDeletes();
        });
        Schema::table('password_resets', function($table) {
            $table->dropSoftDeletes();
        });
	}

}
