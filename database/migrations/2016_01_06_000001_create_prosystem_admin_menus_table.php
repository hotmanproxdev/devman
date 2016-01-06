<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateProsystemAdminMenusTable
 *
 * Generated by ViKon\DbExporter
 */
class CreateProsystemAdminMenusTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('prosystem_admin_menus', function(Blueprint $table) {
$table->integer('id')
      ->unsigned();
$table->string('menu', 255);
$table->string('icon', 255);
$table->string('parent', 14);
$table->string('link', 255);
$table->string('row', 14);
$table->string('statu', 14);

$table->primary('id', 'prim');
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('prosystem_admin_menus');
    }
}