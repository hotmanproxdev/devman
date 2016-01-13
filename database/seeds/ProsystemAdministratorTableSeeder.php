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
				'hash' => '2b2ef7dba7007e91a676e7300ee6ed23',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452680570,
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
				'last_login_time' => 1452679060,
				'user_where' => '/mandev/users',
				'status' => 1,
				'logout' => 0,
				'logout_time' => 0,
			),
			1 => 
			array (
				'id' => 17,
				'ccode' => 'Promedia',
				'username' => 'zeynep',
				'password' => '4c34b4675bebbe13a3515bb906e943c7',
				'email' => 'zeynep@teknasyon.com',
				'hash' => 'c431d5720abc8474c91ee64e1f746710',
				'fullname' => 'Zeynep Karlıcalı',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452675199,
				'updated_at' => 1452678838,
				'photo' => 'default.png',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-2-3',
				'system_name' => 'manager',
				'system_number' => 1,
				'phone_number' => '0545 654 45 67',
				'address' => NULL,
				'occupation' => NULL,
				'website' => NULL,
				'last_login_time' => 1452678789,
				'user_where' => '/mandev/logout',
				'status' => 1,
				'logout' => 1,
				'logout_time' => 1452678838,
			),
			2 => 
			array (
				'id' => 18,
				'ccode' => 'Promedia',
				'username' => 'mervekeser',
				'password' => '104906746b511f3032ff93540103fd35',
				'email' => 'mervekeser@promedia.com.tr',
				'hash' => '9591bc695a852e4a3635e2e0d7a56f8f',
				'fullname' => 'Merve Keser',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452678635,
				'updated_at' => 1452679056,
				'photo' => 'default.png',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-3',
				'system_name' => 'normal',
				'system_number' => 2,
				'phone_number' => '',
				'address' => NULL,
				'occupation' => NULL,
				'website' => NULL,
				'last_login_time' => 1452678867,
				'user_where' => '/mandev/logout',
				'status' => 1,
				'logout' => 1,
				'logout_time' => 1452679056,
			),
		));
	}

}
