<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('ProsystemWordsTableSeeder');
		$this->call('ProsystemAdministratorTableSeeder');
        $this->command->info('table seeded!');
		$this->call('ProsystemRolesTableSeeder');
		$this->call('ProsystemAdministratorProcessLogsTableSeeder');
		$this->call('ProsystemApiAccessesTableSeeder');
		$this->call('ProsystemMysqlSlowProcessLogsTableSeeder');
	}

}
