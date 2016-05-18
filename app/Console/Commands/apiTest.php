<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;

class apiTest extends Command
{
    public $env;
    public $request;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apitest {service} {model?} {method?} {arg?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Api Test Function';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct();
        $this->request=$request;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Session::put("testApi",time());
        $service=explode(":",$this->argument("service"));


        if(!array_key_exists(1,$service))
        {
            $exist=\App\Models\ApiModels::where("custom_models","=",$service[0])->where("version","=",1)->get();
            $dir=str_replace("V1/","",$exist[0]->custom_dir);
            $path='App\Http\Controllers\Api\Custom\V1\\'.$dir.'';
        }
        else
        {
            $exist=\App\Models\ApiModels::where("custom_models","=",$service[0])->where("version","=",1)->get();
            $dir=str_replace("V1/","",$exist[0]->custom_dir);
            $path='App\Http\Controllers\Api\Custom\\'.$service[1].'\\'.$dir.'';
        }



        if($this->argument("model"))
        {
            if($this->argument("model")=="handle")
            {
                $path=''.$path.'\\HandleServer';
            }
            else
            {
                $path=''.$path.'\\'.ucfirst($this->argument("model")).'\\'.$service[0].'Api'.ucfirst($this->argument("model")).'';
            }


        }
        else
        {
            $path=''.$path.'\\'.$service[0].'Api';
        }

        $method=($this->argument("method")) ? $this->argument("method") : 'get';

        if($this->argument("arg"))
        {
            $arg=explode(",",$this->argument("arg"));
            foreach ($arg as $ar)
            {
                $argex=explode(":",$ar);

                if(!array_key_exists(1,$argex))
                {
                    $list[]=$ar;
                }
                else
                {
                    $list[$argex[0]]=$argex[1];
                }
            }

            if($this->argument("arg")=="ref")
            {
                $requested_class="\\".$path."";
                dd(\DB::table(app()->make("Base")->dbTable(['api_reference']))->where("requested_class","=",$requested_class)
                ->where("requested_class_method","=",$method)->get());
            }

            dd(app($path)->$method($list));
        }
        else
        {
            dd(app($path)->$method());
        }

        \Session::forget("testApi");

    }
}
