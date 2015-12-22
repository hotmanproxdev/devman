<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProsystemAdministrator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prosystem_administrator', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('hash')->unique();
            $table->string('fullname');
            $table->string('last_ip');
            $table->integer('created_at',14);
            $table->integer('updated_at',14);
            $table->string('photo');
            $table->text('extra_info');
            $table->integer('lang',14);
            $table->integer('user_lock',14);
            $table->text('role');
            $table->rememberToken();
            $table->timestamps();
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
