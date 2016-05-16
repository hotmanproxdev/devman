<?php

namespace App\Http\Controllers\Api\Custom\V1\profile;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ApiVersionControl as Version;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class HandleServer extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $env;
    public $base;

    public function __construct (Request $request,Version $versionControl,Config $config,Base $base)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get config
        $this->config=$config;
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
        //get Base
        $this->base=$base;
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Handle Server
    |--------------------------------------------------------------------------
    |
    | Here is where you can register data handled for server request of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function get ($data=false)
    {
        /**
         * @method handled condition
         * @result handled array data
         */

        return ['handleserver'];

    }

}
