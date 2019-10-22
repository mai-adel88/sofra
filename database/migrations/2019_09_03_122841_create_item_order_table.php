<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOrderTable extends Migration {

	public function up()
	{
		Schema::create('item_order', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('order_id')->unsigned();
			$table->string('special_note');
			$table->integer('item_id')->unsigned();
			$table->decimal('total_price');
			$table->integer('quantity');
		});
	}

	public function down()
	{
		Schema::drop('item_order');
	}
}