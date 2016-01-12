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
				'hash' => '4aab4893ec252c41a82073e79267f06f',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452612359,
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
				'last_login_time' => 1452611991,
				'user_where' => '/mandev/users',
				'status' => 1,
				'logout' => 0,
				'logout_time' => 0,
			),
			1 => 
			array (
				'id' => 16,
				'ccode' => 'Promedia',
				'username' => 'zeynep',
				'password' => '4c34b4675bebbe13a3515bb906e943c7',
				'email' => 'zeynep@promedia.com.tr',
				'hash' => '93929db0518a6a8690f55ba41d0a81fc',
				'fullname' => 'Zeynep Karlıcalı',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452611885,
				'updated_at' => 1452611987,
				'photo' => 'default.png',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-2-3',
				'system_name' => NULL,
				'system_number' => 1,
				'phone_number' => '',
				'address' => NULL,
				'occupation' => NULL,
				'website' => NULL,
				'last_login_time' => 1452611901,
				'user_where' => '/mandev/logout',
				'status' => 1,
				'logout' => 1,
				'logout_time' => 1452611987,
			),
		));
	}

}
