<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class seeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create auto seed according to default database';

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
        if($this->argument("table")=="all")
        {
            foreach (app()->make("Base")->dbTable(['all']) as $table)
            {
                \Iseed::generateSeed($table);
            }
            dd("seed has been created");
        }
        else
        {
            \Iseed::generateSeed(app()->make("Base")->dbTable([$this->argument("table")]));
            dd("seed has been created");
        }

    }
}
