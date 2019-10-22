<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->integer('region_id')->unsigned();
			$table->string('api_token', 60)->unique()->nullable();
			$table->integer('pin_code')->nullable();
			$table->boolean('active')->default(1);
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}