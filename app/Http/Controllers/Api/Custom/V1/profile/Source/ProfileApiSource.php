<?php

namespace App\Http\Controllers\Api\Custom\V1\profile\Source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class ProfileApiSource extends Controller implements \App\Http\Controllers\Api\InterfaceApi
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $env;
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
    | Application Api Custom Get Method Source
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function get ()
    {
       /**
       * @param Api source
       * @throws return array
       */

        $id=$this->env->name("profile")->model()->select(['id'])->take(1)->run();

        return ($this->env->resolve($id,'id')===56) ? true: false;

    }


    /*
   |--------------------------------------------------------------------------
   | Application Api Custom sourcelist Method Source
   |--------------------------------------------------------------------------
   |
   | Here is where you can register all of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function sourcelist ($data=array())
    {
        /**
         * @param Api source
         * @throws return array
         */
        return ($data['query']) ? 'foo' : 'bar';

    }


    /*
    |--------------------------------------------------------------------------
    | Application Api Custom List Method Source
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function liste ($data=array())
    {
        /**
         * @param Api source
         * @throws return array
         */
        return ($data['query']==="foo") ? ['foox'] : ['zebyan'];

    }

}
