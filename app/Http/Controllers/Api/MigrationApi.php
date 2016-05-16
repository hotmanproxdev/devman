<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;


class MigrationApi extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $status=true;

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
    | Application Api Custom Get Migration
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all tables of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getMigration ()
    {
        /**
         * @method provision condition
         * @result success true|false
         * @false adding msq key and info
         */
        if(app()->env=="production")
        {
            if($this->status)
            {
                return app("\Transaction")->commit(function()
                {
                    //dont delete this comment line
                });
            }
        }

    }

}
