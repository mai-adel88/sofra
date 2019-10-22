<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->decimal('paid');
			$table->integer('restaurant_id')->unsigned();
			$table->text('note')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}