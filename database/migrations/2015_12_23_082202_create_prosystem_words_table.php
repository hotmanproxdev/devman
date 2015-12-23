<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProsystemWordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prosystem_words', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('url_path');
			$table->text('word_data');
			$table->integer('lang');
			$table->integer('updated_at');
			$table->index(['url_path','lang'], 'url_path');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prosystem_words');
	}

}
