<?php

use Illuminate\Database\Seeder;

class ProsystemMysqlSlowProcessLogsTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('prosystem_mysql_slow_process_logs')->delete();
        
	}

}
