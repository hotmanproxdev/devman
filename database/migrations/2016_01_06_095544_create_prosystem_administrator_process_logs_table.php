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
			$table->char('isoCode')->nullable();
			$table->char('country')->nullable()->index('country');
			$table->char('city')->nullable();
			$table->char('state')->nullable();
			$table->char('postal_code')->nullable();
			$table->float('lat', 10, 0)->nullable();
			$table->float('lon', 10, 0)->nullable();
			$table->char('timezone')->nullable();
			$table->char('continent')->nullable();
			$table->integer('isMobile')->nullable()->index('isMobile');
			$table->integer('isTablet')->nullable()->index('isTablet');
			$table->integer('isDesktop')->nullable()->index('isDesktop');
			$table->integer('isBot')->nullable()->index('isBot');
			$table->char('browserFamily')->nullable();
			$table->char('browserVersionMajor')->nullable();
			$table->char('browserVersionMinor')->nullable();
			$table->char('browserVersionPatch')->nullable();
			$table->char('osFamily')->nullable()->index('osFamily');
			$table->char('osVersionMajor')->nullable();
			$table->char('osVersionMinor')->nullable();
			$table->char('osVersionPatch')->nullable();
			$table->char('deviceFamily')->nullable();
			$table->char('deviceModel')->nullable();
			$table->char('mobileGrade')->nullable();
			$table->char('cssVersion')->nullable();
			$table->integer('javaScriptSupport')->nullable();
			$table->char('formprocess')->default('');
			$table->char('user_agent');
			$table->char('user_host');
			$table->char('url_path');
			$table->char('url_path_explain')->index('url_path_explain');
			$table->integer('log_process')->index('log_process');
			$table->text('msg')->nullable();
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
