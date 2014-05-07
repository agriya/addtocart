<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Config;
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
			$table->integer('qty');
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
