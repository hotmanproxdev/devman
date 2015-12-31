<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProsystemAdministratorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prosystem_administrator', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('ccode')->nullable();
			$table->char('username')->index('username');
			$table->char('password')->index('password');
			$table->char('hash')->index('hash');
			$table->char('fullname');
			$table->char('last_ip');
			$table->integer('created_at');
			$table->integer('updated_at')->index('updated_at');
			$table->char('photo');
			$table->text('extra_info');
			$table->integer('lang')->default(1);
			$table->integer('user_lock')->nullable()->default(1);
			$table->text('role');
			$table->char('system_name')->nullable()->default('');
			$table->char('phone_number')->nullable();
			$table->text('address')->nullable();
			$table->char('occupation')->nullable()->default('');
			$table->char('website')->nullable();
			$table->integer('last_login_time')->nullable();
			$table->char('user_where')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('prosystem_administrator');
	}

}
