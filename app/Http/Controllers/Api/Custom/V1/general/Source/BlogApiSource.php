<?php

namespace App\Http\Controllers\Api\Custom\V1\general\Source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;


class BlogApiSource extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;

    public function __construct (Request $request,Config $config)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get config
        $this->config=$config;

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
       return ['foo'];
    }

}
