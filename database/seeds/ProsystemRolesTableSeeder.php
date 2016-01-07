<?php

use Illuminate\Database\Seeder;

class ProsystemRolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_roles')->delete();
        
		\DB::table('prosystem_roles')->insert(array (
			0 => 
			array (
				'id' => 1,
				'role_define' => 'main',
				'role_info' => 'Kullanici anasayfadaki verileri gorebilsin mi?',
				'lang' => 1,
				'created_at' => 0,
				'updated_at' => 0,
				'statu' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'role_define' => 'users',
				'role_info' => 'Kullanici -kullanicilar bolumu- sayfasindaki verileri gorebilsin mi?',
				'lang' => 1,
				'created_at' => 0,
				'updated_at' => 0,
				'statu' => 1,
			),
		));
	}

}
