<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('names', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_str');
			$table->string('name');
			$table->string('screen_name');
			$table->string('profile_image_url');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('names');
	}

}
