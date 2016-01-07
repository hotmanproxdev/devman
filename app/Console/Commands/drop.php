<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class drop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'drop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Drop Table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        foreach (app()->make("Base")->dbTable(['all']) as $tables)
        {
            DB::table($tables)->drop();
        }
        dd("drop has been applied");

    }
}
