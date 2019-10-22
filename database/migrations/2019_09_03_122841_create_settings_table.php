<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('about_app');
			$table->decimal('commission');
			$table->decimal('max_credit');
			$table->text('head');
			$table->string('footer');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}