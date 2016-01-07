<?php

use Illuminate\Database\Seeder;

class ProsystemApiAccessesTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_api_accesses')->delete();
        
		\DB::table('prosystem_api_accesses')->insert(array (
			0 => 
			array (
				'id' => 1,
				'ccode' => 'devSde',
				'ip' => '::1',
				'apikey' => 'devProAge',
				'statu' => 1,
			),
			1 => 
			array (
				'id' => 2,
				'ccode' => 'tkasabasi',
				'ip' => '::1',
				'apikey' => 'csenx12',
				'statu' => 1,
			),
		));
	}

}
