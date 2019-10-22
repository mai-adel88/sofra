<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemOffersTable extends Migration {

	public function up()
	{
		Schema::create('item_offers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('product_offer_name');
			$table->text('description');
			$table->date('from');
			$table->date('to');
			$table->string('image')->nullable();
			$table->integer('restaurant_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('item_offers');
	}
}