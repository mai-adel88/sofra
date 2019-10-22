<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('region_id')->unsigned();
			$table->string('password');
			$table->string('mini_charge');
			$table->decimal('delivery_fee');
			$table->string('phone_delivery');
			$table->string('whatsapp');
			$table->string('image');
			$table->boolean('status');
			$table->string('api_token', 60)->unique()->nullable();
			$table->integer('pin_code')->nullable();
			$table->boolean('active')->default(1);

			
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}