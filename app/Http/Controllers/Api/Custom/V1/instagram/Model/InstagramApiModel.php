<?php

namespace App\Http\Controllers\Api\Custom\V1\instagram\Model;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class InstagramApiModel extends Controller implements \App\Http\Controllers\Api\InterfaceApi
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
    | Application Api Custom Get Method Modelling
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function get ($data=false)
    {
       //make query
       return \App\Models\Admin
                                          ::select($this->config->select($data))
                                          ->where(function ($query) use ($data)
                                          {
                                             foreach ($this->config->where($data) as $key=>$value)
                                             {
                                                 if(is_array($value))
                                                 {
                                                    $query->whereIn($key,$value);
                                                 }
                                                 else
                                                 {
                                                    $query->where($key,$this->config->whereOpt($key),$value);
                                                 }

                                             }
                                          })
                                          ->orderBy("id","desc")
                                          ->skip($this->config->pageNumber())
                                          ->take($this->config->take())
                                          ->get();
    }





}
