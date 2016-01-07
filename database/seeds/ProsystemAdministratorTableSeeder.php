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
				'hash' => '3264f3fff00548c3ff4bd1b91d4fc661',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452167543,
				'photo' => '48832.jpg',
				'extra_info' => 'it can be written later',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1',
				'system_name' => 'Developer
',
				'phone_number' => '0545 906 29 92',
				'address' => 'İstanbul',
				'occupation' => 'Software Developer',
				'website' => 'http://sw.devx.net',
				'last_login_time' => 1452162242,
				'user_where' => '/mandev/login',
			),
		));
	}

}
