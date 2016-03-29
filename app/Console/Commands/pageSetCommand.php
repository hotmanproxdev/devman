<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\Factory;
class pageSetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'page {page} {dir?} {sourcefile?}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new page';
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
        $slashes='/';

        $routes="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."routes.php";
        $app_path="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."Controllers".$slashes."";
        $view_path="".str_replace("".$slashes."storage".$slashes."app","",storage_path("app"))."".$slashes."resources".$slashes."views".$slashes."";

        if($this->argument("page")=="source")
        {
            if(file_exists("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."source"))
            {
                if(touch("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."source".$slashes."".$this->argument("sourcefile")."Controller.php"))
                {

                    if($this->argument("sourcefile")=="tsql")
                    {
                        $dosya = "".storage_path("app")."".$slashes."sourceFileTsql.txt";
                    }
                    else
                    {
                        $dosya = "".storage_path("app")."".$slashes."sourceFile.txt";
                    }

                    $dt = fopen($dosya, "rb");
                    $icerik = fread($dt, filesize($dosya));
                    $dosya = "".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."source".$slashes."".$this->argument("sourcefile")."Controller.php";
                    $dt = fopen($dosya, 'w');
                    $icerik=str_replace("__sourceName__",ucfirst($this->argument("dir")),$icerik);
                    $icerik=str_replace("__sourceNameModel__",$this->argument("dir"),$icerik);
                    $icerik=str_replace("__sourceNamePath__",$this->argument("dir"),$icerik);
                    $icerik=str_replace("__sourceFile__",$this->argument("sourcefile"),$icerik);
                    fwrite($dt,$icerik);
                    fclose($dt);

                    dd("source file has been created");

                }
                else
                {
                    dd("source file error");
                }



            }
        }

        if(!file_exists("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir")).""))
        {
            mkdir("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."", 0777, true);
            chmod("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."", 0777);


        }


        mkdir("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".ucfirst($this->argument("page"))."", 0777, true);
        chmod("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".ucfirst($this->argument("page"))."", 0777);


        mkdir("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("page"))."".$slashes."source", 0777, true);
        chmod("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("page"))."".$slashes."source", 0777);


        if(touch("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("page"))."".$slashes."source".$slashes."sourceController.php"))
        {

            $dosya = "".storage_path("app")."".$slashes."source.txt";
            $dt = fopen($dosya, "rb");
            $icerik = fread($dt, filesize($dosya));
            $dosya = "".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("page"))."".$slashes."source".$slashes."sourceController.php";
            $dt = fopen($dosya, 'w');
            $icerik=str_replace("__sourceName__",ucfirst($this->argument("page")),$icerik);
            fwrite($dt,$icerik);
            fclose($dt);


        }



        if(touch("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."".$this->argument("page")."Controller.php"))
        {

            $dosya = "".storage_path("app")."".$slashes."test.txt";
            $dt = fopen($dosya, "rb");
            $icerik = fread($dt, filesize($dosya));
            $dosya = "".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."".$this->argument("page")."Controller.php";
            $dt = fopen($dosya, 'w');
            $icerik=str_replace("test",$this->argument("page"),$icerik);
            $icerik=str_replace("__dir",ucfirst($this->argument("dir")),$icerik);
            $icerik=str_replace("{dir}",ucfirst($this->argument("dir")),$icerik);
            $icerik=str_replace("__namespace",ucfirst($this->argument("page")),$icerik);
            $icerik=str_replace("{pr}",ucfirst(config("app.admin_dirname")),$icerik);
            fwrite($dt,$icerik);
            fclose($dt);


            $routechange="
      //dont delete this comment line

      //".$this->argument("page")." part
      Route::group(['namespace'=>'".ucfirst($this->argument("page"))."'], function ()
      {
            //".$this->argument("page")." route (".$this->argument("page")."Controller)
            Route::controllers(['".$this->argument("page")."' => '".$this->argument("page")."Controller']);
      });

            ";

            $dt = fopen($routes, "rb");
            $icerik = fread($dt, filesize($routes));
            $dt = fopen($routes, 'w');
            $icerik=str_replace("//dont delete this comment line",$routechange,$icerik);
            fwrite($dt,$icerik);
            fclose($dt);



            if(touch("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."".$this->argument("page")."Model.php"))
            {

                $dosya = "".storage_path("app")."".$slashes."testmodel.txt";
                $dt = fopen($dosya, "rb");
                $icerik = fread($dt, filesize($dosya));
                $dosya = "".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."".$this->argument("page")."Model.php";
                $dt = fopen($dosya, 'w');
                $icerik=str_replace("test",$this->argument("page"),$icerik);
                $icerik=str_replace("__dir",ucfirst($this->argument("dir")),$icerik);
                $icerik=str_replace("{dir}",ucfirst($this->argument("dir")),$icerik);
                $icerik=str_replace("__namespace",ucfirst($this->argument("page")),$icerik);
                $icerik=str_replace("{pr}",ucfirst(config("app.admin_dirname")),$icerik);
                fwrite($dt,$icerik);
                fclose($dt);
            }







            mkdir("".$view_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."", 0777, true);
            chmod("".$view_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."", 0777);
            if(touch("".$view_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."main.blade.php"))
            {
                if(touch("".$view_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."".$this->argument("page")."_content.blade.php"))
                {
                    $dosya = "".storage_path("app")."".$slashes."test_main.txt";
                    $dt = fopen($dosya, "rb");
                    $icerik = fread($dt, filesize($dosya));
                    $dosya = "".$view_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."main.blade.php";
                    $dt = fopen($dosya, 'w');
                    $icerik=str_replace("test",$this->argument("page"),$icerik);
                    $icerik=str_replace("{dir}",$this->argument("dir"),$icerik);
                    $icerik=str_replace("{pr}",ucfirst(config("app.admin_dirname")),$icerik);
                    fwrite($dt,$icerik);
                    $dosya = "".storage_path("app")."".$slashes."test_content.txt";
                    $dt = fopen($dosya, "rb");
                    $icerik = fread($dt, filesize($dosya));
                    $dosya = "".$view_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".$this->argument("page")."".$slashes."".$this->argument("page")."_content.blade.php";
                    $dt = fopen($dosya, 'w');
                    fwrite($dt,$icerik);
                    fclose($dt);
                }
            }
            dd("File has been created");
        }
    }
}