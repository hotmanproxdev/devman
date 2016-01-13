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
				'hash' => '225d2f3993016bb2ab100f13c783fde7',
				'fullname' => 'Ali Bilge Gürbüz',
				'last_ip' => '127.0.0.1',
				'created_at' => 1447331070,
				'updated_at' => 1452692125,
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
				'last_login_time' => 1452691955,
				'user_where' => '/mandev/users',
				'status' => 1,
				'logout' => 0,
				'logout_time' => 0,
				'created_by' => NULL,
				'is_mobile' => 0,
				'is_tablet' => 0,
				'is_desktop' => 1,
				'is_bot' => 0,
				'browser_family' => 'Safari',
				'os_family' => 'MacOSX',
			),
			1 => 
			array (
				'id' => 20,
				'ccode' => 'Promedia',
				'username' => 'zeynep',
				'password' => '4c34b4675bebbe13a3515bb906e943c7',
				'email' => 'zeynep@promedia.com.tr',
				'hash' => 'eda4c640e20669018599378eef5dce30',
				'fullname' => 'Zeynep Kasarcalı',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452691044,
				'updated_at' => 1452691920,
				'photo' => 'default.png',
				'extra_info' => '',
				'lang' => 1,
				'user_lock' => 1,
				'role' => '1-2-3',
				'system_name' => 'manager',
				'system_number' => 1,
				'phone_number' => '0543 234 56 78',
				'address' => NULL,
				'occupation' => NULL,
				'website' => NULL,
				'last_login_time' => 1452691651,
				'user_where' => '/mandev/logout',
				'status' => 1,
				'logout' => 1,
				'logout_time' => 1452691920,
				'created_by' => 1,
				'is_mobile' => 0,
				'is_tablet' => 0,
				'is_desktop' => 1,
				'is_bot' => 0,
				'browser_family' => 'Chrome',
				'os_family' => 'MacOSX',
			),
			2 => 
			array (
				'id' => 21,
				'ccode' => 'Promedia',
				'username' => 'emrekoca',
				'password' => '0ac9444c86e7c60b520c68e9c3cbaa69',
				'email' => 'emrekoca@promedia.com.tr',
				'hash' => 'bbe4465a2656dcfc7467506dfa1c26bc',
				'fullname' => 'Emre Hakkı Koca',
				'last_ip' => '127.0.0.1',
				'created_at' => 1452691708,
				'updated_at' => 1452692121,
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
				'last_login_time' => 1452691929,
				'user_where' => '/mandev/profile',
				'status' => 1,
				'logout' => 0,
				'logout_time' => 0,
				'created_by' => 20,
				'is_mobile' => 0,
				'is_tablet' => 0,
				'is_desktop' => 1,
				'is_bot' => 0,
				'browser_family' => 'Chrome',
				'os_family' => 'MacOSX',
			),
		));
	}

}
