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
            $slashes='/';

            $app_path="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."Controllers".$slashes."Api".$slashes."Custom".$slashes."";

            if(!file_exists("".$app_path."".ucfirst($this->argument("custom"))."Api.php"))
            {
                if(touch("".$app_path."".ucfirst($this->argument("custom"))."Api.php"))
                {

                    $dosya = "" . storage_path("app") . "" . $slashes . "apiCustom.txt";
                    $dt = fopen($dosya, "rb");
                    $icerik = fread($dt, filesize($dosya));
                    $dosya = "".$app_path."".ucfirst($this->argument("custom"))."Api.php";
                    $dt = fopen($dosya, 'w');
                    $icerik=str_replace("{custom}",ucfirst($this->argument("custom")),$icerik);
                    fwrite($dt, $icerik);
                    fclose($dt);

                    dd("api custom model has been created");
                }
            }
        }
    }
}
