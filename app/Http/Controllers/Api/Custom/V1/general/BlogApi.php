<?php

namespace App\Http\Controllers\Api\Custom\V1\general;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ApiVersionControl as Version;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\Custom\V1\general\Model\BlogApiModel as Model;


class BlogApi extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $model;

    public function __construct (Request $request,Version $versionControl,Config $config,Model $model)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //version control
        $this->versionControl=$versionControl;
        //get config
        $this->config=$config;
        //get model
        $this->model=$model;
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function get ()
    {
        //get version
        return $this->versionControl->get([__CLASS__,__METHOD__],function()
        {
           //your query
           $query=$this->model->get();

           //output send
           return $this->config->output($query);

        });
    }



}
