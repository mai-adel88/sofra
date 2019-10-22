<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactUsTable extends Migration {

	public function up()
	{
		Schema::create('contact_us', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('full_name');
			$table->string('email');
			$table->string('phone');
			$table->string('message');
			$table->enum('states', array('Complaint', 'Suggestion', 'Enquiry'));
		});
	}

	public function down()
	{
		Schema::drop('contact_us');
	}
}