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
    public function getFix()
    {
         /**
         * @param App $app
         * @throws callable method
         */
         return ['base'];
    }



}