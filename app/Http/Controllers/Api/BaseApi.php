<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;

class BaseApi extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $config;

    public function __construct(Request $request,Config $config)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
        //get config
        $this->config=$config;
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Base Method
    |--------------------------------------------------------------------------
    |
    | Here is where you can call it for all service of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */
    public function getUser()
    {
         /**
         * @param App $app api user
         * @throws callable method
         */
         return Session("laraapikey")[0];
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Base Method Browser Detect
    |--------------------------------------------------------------------------
    |
    | Here is where you can call it's browser info for user of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */
    public function getBrowser($is,$callback=false)
    {
        /**
         * @param App $app browser detect
         * @throws callable method
         */
        $browser=\BrowserDetect::toArray();

         /**
         * @param App $app isType key_exists and true
         * @throws callback run
         */
        if(array_key_exists($is,$browser) && $browser[$is])
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }

            return $browser[$is];
        }

        return [];
    }



}