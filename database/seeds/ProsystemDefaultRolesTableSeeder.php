<?php

use Illuminate\Database\Seeder;

class ProsystemDefaultRolesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_default_roles')->delete();
        
		\DB::table('prosystem_default_roles')->insert(array (
			0 => 
			array (
				'id' => 1,
				'role_name' => 'developer',
				'system_number' => 0,
				'roles' => NULL,
				'role_row' => 3,
			),
			1 => 
			array (
				'id' => 2,
				'role_name' => 'manager',
				'system_number' => 1,
				'roles' => '1-2-3',
				'role_row' => 2,
			),
			2 => 
			array (
				'id' => 3,
				'role_name' => 'normal',
				'system_number' => 2,
				'roles' => '1-3',
				'role_row' => 1,
			),
		));
	}

}
