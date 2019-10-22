<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('address');
			$table->enum('state', array('pending', 'accepted', 'rejected', 'declined', 'delivered'));
			$table->integer('client_id')->unsigned();
			$table->integer('restaurant_id')->unsigned();
			$table->decimal('commission');
			$table->decimal('cost');
			$table->decimal('total'); //cost+delivery_fee
			$table->decimal('net');
			$table->integer('payment_method_id')->unsigned();
			$table->decimal('delivery_fee');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}