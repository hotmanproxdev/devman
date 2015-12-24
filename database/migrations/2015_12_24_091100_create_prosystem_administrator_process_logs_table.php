<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProsystemAdministratorProcessLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prosystem_administrator_process_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('userid')->index('userid');
			$table->char('userip');
			$table->char('formprocess')->default('');
			$table->char('user_agent');
			$table->char('user_host');
			$table->char('url_path');
			$table->char('url_path_explain');
			$table->integer('log_process')->index('log_process');
			$table->text('postdata');
			$table->integer('created_at')->index('created_at');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prosystem_administrator_process_logs');
	}

}
