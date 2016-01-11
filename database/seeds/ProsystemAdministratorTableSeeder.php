<?php

use Illuminate\Database\Seeder;

class ProsystemAdministratorTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_administrator')->delete();
        
		\DB::table('prosystem_administrator')->insert(array (
			0 => 
			array (
				'id' => 1,
				'ccode' => 'devSde',
				'username' => 'aligurbuz',
				'password' => '7ada520f7fb0eb935a11f392511fe86e',
				'email' => 'galiant781@gmail.com',
				'hash' => '3d1e5a0124da480128adba968f9d9bd2',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452523854,
				'photo' => '48832.jpg',
				'extra_info' => 'it can be written later',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-2-3',
				'system_name' => 'Developer
',
				'system_number' => 0,
				'phone_number' => '0545 906 29 92',
				'address' => 'İstanbul',
				'occupation' => 'Software Developer',
				'website' => 'http://sw.devx.net',
				'last_login_time' => 1452508134,
				'user_where' => '/mandev/users/newuser',
				'status' => 1,
			),
			1 => 
			array (
				'id' => 7,
				'ccode' => 'teknasyon',
				'username' => 'alimyildiz',
				'password' => 'ed60d74295c612b172bceba531e45e66',
				'email' => 'alim@teknasyon.com',
				'hash' => 'ec033977815b9e5cbc2259b7c0e6f86d',
				'fullname' => 'Alim Yıldız',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452507963,
				'updated_at' => 0,
				'photo' => 'default.png',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-3',
				'system_name' => NULL,
				'system_number' => NULL,
				'phone_number' => '',
				'address' => NULL,
				'occupation' => NULL,
				'website' => NULL,
				'last_login_time' => 1452508117,
				'user_where' => '/mandev/logout',
				'status' => 1,
			),
		));
	}

}
