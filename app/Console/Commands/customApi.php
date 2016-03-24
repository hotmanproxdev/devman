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
    protected $signature = 'apicustom {custom} {dir}';

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
        if($this->argument("custom")=="test")
        {
            dd("you dont have permission creating a class called test");
        }

        if(array_key_exists($this->argument("custom"),app()->make("Base")->dbTable(['all'])))
        {
            dd("you dont have permission creating a class called ".$this->argument("custom")."");
        }

        if(!preg_match('@v(\d+)\/.+@is',$this->argument("dir")))
        {
            dd("Versioning is false.Please,start with V(n)/");
        }

        $versioning=explode("/",$this->argument("dir"));
        $versioning=str_replace("v","",$versioning[0]);


        $main=\DB::table(app()->make("Base")->dbTable(['api_custom']));

        //$customExist=$main->where("custom_models","=",$this->argument("custom"))->get();

        if(true)
        {
            if($main->insert(['custom_models'=>$this->argument("custom"),'custom_dir'=>($this->argument("dir")) ? ucfirst($this->argument("dir")) : NULL,'version'=>$versioning,'users'=>0,'created_at'=>time()]))
            {
                $slashes='/';

                $app_path="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."Controllers".$slashes."Api".$slashes."Custom".$slashes."";


                if($this->argument("dir"))
                {
                    $dir=explode("/",$this->argument("dir"));

                    if(!file_exists("".$app_path."".ucfirst($this->argument("dir")).""))
                    {
                        mkdir("".$app_path."".ucfirst($this->argument("dir"))."", 0777, true);
                        chmod("".$app_path."".ucfirst($this->argument("dir"))."", 0777);

                    }

                    $app_path="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."Controllers".$slashes."Api".$slashes."Custom".$slashes."".$this->argument("dir")."".$slashes."";

                }

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
                        if($this->argument("dir"))
                        {
                            $icerik=str_replace("{namespace}","\\".str_replace("/","\\",ucfirst($this->argument("dir")))."",$icerik);
                        }
                        else
                        {
                            $icerik=str_replace("{namespace}","",$icerik);
                        }

                        fwrite($dt, $icerik);
                        fclose($dt);

                        dd("api custom model has been created");
                    }
                }
            }
        }




    }
}
