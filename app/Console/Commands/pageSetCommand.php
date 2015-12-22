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
    protected $signature = 'page {page} {dir?}';
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
        
        $app_path="".str_replace("".$slashes."storage","",storage_path("app"))."".$slashes."Http".$slashes."Controllers".$slashes."";
        $view_path="".str_replace("".$slashes."storage".$slashes."app","",storage_path("app"))."".$slashes."resources".$slashes."views".$slashes."";
        if(!file_exists("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir")).""))
        {
            mkdir("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."", 0777, true);
            chmod("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."", 0777);
        }
        mkdir("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".ucfirst($this->argument("page"))."", 0777, true);
        chmod("".$app_path."".config("app.admin_dirname")."".$slashes."".ucfirst($this->argument("dir"))."".$slashes."".ucfirst($this->argument("page"))."", 0777);
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