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
				'hash' => '9396fe8c7d7264844e8adf388d39cd87',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452505864,
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
				'last_login_time' => 1452499497,
				'user_where' => '/mandev/users',
				'status' => 1,
			),
			1 => 
			array (
				'id' => 6,
				'ccode' => 'teknasyon',
				'username' => 'alimyildiz',
				'password' => 'ed60d74295c612b172bceba531e45e66',
				'email' => 'alim@teknasyon.com',
				'hash' => 'a38cb1af2f60a94f88f5c310ad18a5e6',
				'fullname' => 'Alim Yıldız',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452498590,
				'updated_at' => 0,
				'photo' => 'default.png',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '',
				'system_name' => NULL,
				'system_number' => NULL,
				'phone_number' => '',
				'address' => NULL,
				'occupation' => NULL,
				'website' => NULL,
				'last_login_time' => 1452499473,
				'user_where' => '/mandev/logout',
				'status' => 1,
			),
		));
	}

}
