<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class apiVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apiversion {plan} {var1} {var2}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ApiVersion process';

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
        if($this->argument("plan")=="move")
        {
            $slashes='/';
            $app_path="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."Controllers";

            $sourcepath=''.$app_path.''.$slashes.'Api'.$slashes.'Custom'.$slashes.''.ucfirst($this->argument("var1")).'';
            $destinationpath=''.$app_path.''.$slashes.'Api'.$slashes.'Custom'.$slashes.''.ucfirst($this->argument("var2")).'';

            if(!file_exists($destinationpath))
            {
                mkdir($destinationpath,0777,true);
                chmod($destinationpath,0777);
                app("\Base")->xcopy($sourcepath,$destinationpath);

                $list=[];
                $return=app("\Base")->listFolderFiles($destinationpath,$slashes);

                foreach ($return as $key=>$value)
                {
                    foreach ($return[$key] as $a=>$b)
                    {
                        if(is_array($b))
                        {
                            foreach ($b as $x)
                            {
                                $list[]=$x;
                            }
                        }
                        else
                        {
                            $list[]=$b;
                        }
                    }

                }


                foreach ($list as $val)
                {
                    $dosya =$val;
                    $dt = fopen($dosya, "rb");
                    $icerik = fread($dt, filesize($dosya));
                    $icerik=preg_replace('@Custom\\\V(\d+)@',"Custom\\".ucfirst($this->argument("var2"))."",$icerik);

                    $dt = fopen($dosya, 'w');

                    fwrite($dt,$icerik);
                    fclose($dt);
                }

                dd("version has been created");
            }



        }
    }
}
