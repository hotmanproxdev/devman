<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateProsystemAdministratorProcessLogsTable
 *
 * Generated by ViKon\DbExporter
 */
class CreateProsystemAdministratorProcessLogsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prosystem_administrator_process_logs', function(Blueprint $table) {
$table->increments('id')
      ->unsigned();
$table->integer('userid');
$table->string('userip', 255);
$table->string('iso_code', 255)
      ->nullable()
      ->default(NULL);
$table->string('country', 255)
      ->nullable()
      ->default(NULL);
$table->string('city', 255)
      ->nullable()
      ->default(NULL);
$table->string('state', 255)
      ->nullable()
      ->default(NULL);
$table->string('postal_code', 255)
      ->nullable()
      ->default(NULL);
$table->float('lat')
      ->nullable()
      ->default(NULL);
$table->float('lon')
      ->nullable()
      ->default(NULL);
$table->string('timezone', 255)
      ->nullable()
      ->default(NULL);
$table->string('continent', 255)
      ->nullable()
      ->default(NULL);
$table->integer('is_mobile')
      ->nullable()
      ->default(NULL);
$table->integer('is_tablet')
      ->nullable()
      ->default(NULL);
$table->integer('is_desktop')
      ->nullable()
      ->default(NULL);
$table->integer('is_bot')
      ->nullable()
      ->default(NULL);
$table->string('browser_family', 255)
      ->nullable()
      ->default(NULL);
$table->string('browser_version_major', 255)
      ->nullable()
      ->default(NULL);
$table->string('browser_version_minor', 255)
      ->nullable()
      ->default(NULL);
$table->string('browser_version_patch', 255)
      ->nullable()
      ->default(NULL);
$table->string('os_family', 255)
      ->nullable()
      ->default(NULL);
$table->string('os_version_major', 255)
      ->nullable()
      ->default(NULL);
$table->string('os_version_minor', 255)
      ->nullable()
      ->default(NULL);
$table->string('os_version_patch', 255)
      ->nullable()
      ->default(NULL);
$table->string('device_family', 255)
      ->nullable()
      ->default(NULL);
$table->string('device_model', 255)
      ->nullable()
      ->default(NULL);
$table->string('mobile_grade', 255)
      ->nullable()
      ->default(NULL);
$table->string('css_version', 255)
      ->nullable()
      ->default(NULL);
$table->integer('java_script_support')
      ->nullable()
      ->default(NULL);
$table->string('formprocess', 255);
$table->string('user_agent', 255);
$table->string('user_host', 255);
$table->string('url_path', 255);
$table->string('url_path_explain', 255);
$table->integer('log_process');
$table->text('msg')
      ->nullable()
      ->default(NULL);
$table->text('postdata');
$table->integer('created_at');

$table->index('userid', 'userid');
$table->index('created_at', 'created_at');
$table->index('log_process', 'log_process');
$table->index('is_mobile', 'is_mobile');
$table->index('is_tablet', 'is_tablet');
$table->index('is_desktop', 'is_desktop');
$table->index('is_bot', 'is_bot');
$table->index('os_family', 'os_family');
$table->index('url_path_explain', 'url_path_explain');
$table->index('country', 'country');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prosystem_administrator_process_logs');
    }
}