<?php

use Illuminate\Database\Seeder;

class ProsystemAdministratorProcessLogsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_administrator_process_logs')->delete();
        
	}

}
