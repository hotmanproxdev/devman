<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class customApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apicustom {custom}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generator custom api model';

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
        if(\DB::table(app()->make("Base")->dbTable(['api_custom']))->insert(['custom_models'=>$this->argument("custom"),'users'=>0,'created_at'=>time()]))
        {
            dd("custom api model has been created");
        }
    }
}
