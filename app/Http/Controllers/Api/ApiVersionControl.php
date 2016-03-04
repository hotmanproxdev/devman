<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ApiVersionControl extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $model;

    public function __construct(Request $request)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
    }


    public function get($namespace,$callback)
    {
        $val=true;

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }
    }

}