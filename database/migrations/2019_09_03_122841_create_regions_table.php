<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('city_id')->unsigned();
			$table->string('name');
		});

		App\Region::create(['name' => 'test','city_id' => '1']);
		App\Region::create(['name' => 'test2','city_id' => '1']);
	}

	public function down()
	{
		Schema::drop('regions');
	}
}