<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_cart', function($table)
		{
			$table->increments('id');
			$table->bigInteger('user_id');
			$table->string('item_id');
			$table->bigInteger('item_owner_id');
			$table->integer('qty');
			$table->dateTime('date_added');
			$table->dateTime('date_modified');
			$table->string('cookie_id', 50);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_cart');
	}

}
