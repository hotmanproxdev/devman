<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class ProvisionApi extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $env;
    public $methods=array("getPlatform");
    public $base;

    public function __construct (Request $request,Config $config,Base $base)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get config
        $this->config=$config;
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
        //get base
        $this->base=$base;
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Provision
    |--------------------------------------------------------------------------
    |
    | Here is where you can register provision of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getPlatform ()
    {
         /**
         * @method provision condition
         * @result success true|false
         * @false adding msq key and info
         */
         return ['success'=>true,'msg'=>'provision getplatform'];
    }


    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Post Provision
    |--------------------------------------------------------------------------
    |
    | Here is where you can register post provision of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function postProvision ()
    {
        /**
         * @method provision condition
         * @result success true|false
         * @false adding msq key and info
         */

        if($this->request->header("postdata"))
        {
            return ['success'=>true];
        }

        return ['success'=>false,'msg'=>'post provision condition'];
    }




    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Provision Run
    |--------------------------------------------------------------------------
    |
    | Here is where you can run provisions for your application.
    | It's a simple. if there is in methods object the methods
    | you will run except for 'run method'.They is ran automatically
    | and if there is no boolean false,application is continued
    |
    */

    public function run ()
    {
        /**
        * @env it runs environment class provision condition
        * @make methods array run
        */
        return $this->env->make($this->methods,function()
        {
            return true;
        });
    }





}
