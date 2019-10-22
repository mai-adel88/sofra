<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
		});
		App\City::create(['name' => 'test']);
		App\City::create(['name' => 'test']);
	}

	public function down()
	{
		Schema::drop('cities');
	}
}