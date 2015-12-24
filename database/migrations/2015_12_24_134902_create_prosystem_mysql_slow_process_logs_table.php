<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProsystemMysqlSlowProcessLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prosystem_mysql_slow_process_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('url_path');
			$table->text('query_log')->nullable();
			$table->text('query_bindings')->nullable();
			$table->float('query_time', 10, 0)->nullable();
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
		Schema::drop('prosystem_mysql_slow_process_logs');
	}

}
