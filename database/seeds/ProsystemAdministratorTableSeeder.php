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
				'hash' => '2c40689b41e13bdfa618a7449baa75c6',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452777546,
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
				'last_login_time' => 1452776720,
				'user_where' => '/mandev/login',
				'status' => 1,
				'logout' => 0,
				'logout_time' => 0,
				'created_by' => NULL,
				'is_mobile' => 0,
				'is_tablet' => 0,
				'is_desktop' => 0,
				'is_bot' => 0,
				'browser_family' => 'Chrome',
				'os_family' => 'MacOSX',
				'all_clicked' => 0,
				'hash_clicked' => 0,
				'operations' => 0,
				'success_operations' => 0,
				'fail_operations' => 0,
				'noauth_area_operations' => 0,
			),
		));
	}

}
