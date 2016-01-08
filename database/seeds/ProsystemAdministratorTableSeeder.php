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
				'hash' => 'c726e5ab225c0e6b78530b0048706771',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452263009,
				'photo' => '48832.jpg',
				'extra_info' => 'it can be written later',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-2',
				'system_name' => 'Developer
',
				'system_number' => 0,
				'phone_number' => '0545 906 29 92',
				'address' => 'İstanbul',
				'occupation' => 'Software Developer',
				'website' => 'http://sw.devx.net',
				'last_login_time' => 1452252645,
				'user_where' => '/mandev/users/newuser',
				'status' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'ccode' => 'aaaa',
				'username' => '',
				'password' => '',
				'email' => NULL,
				'hash' => '',
				'fullname' => '',
				'last_ip' => '',
				'created_at' => 0,
				'updated_at' => 0,
				'photo' => '',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '',
				'system_name' => '',
				'system_number' => NULL,
				'phone_number' => NULL,
				'address' => NULL,
				'occupation' => '',
				'website' => NULL,
				'last_login_time' => NULL,
				'user_where' => NULL,
				'status' => NULL,
			),
			2 => 
			array (
				'id' => 3,
				'ccode' => 'test',
				'username' => 'testuser',
				'password' => '123456',
				'email' => 'test1@teknasyon.com',
				'hash' => '',
				'fullname' => 'testuser',
				'last_ip' => '',
				'created_at' => 0,
				'updated_at' => 0,
				'photo' => '',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '',
				'system_name' => '',
				'system_number' => NULL,
				'phone_number' => '',
				'address' => NULL,
				'occupation' => '',
				'website' => NULL,
				'last_login_time' => NULL,
				'user_where' => NULL,
				'status' => 1,
			),
		));
	}

}
