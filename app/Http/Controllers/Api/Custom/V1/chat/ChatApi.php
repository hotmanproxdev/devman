<?php

namespace App\Http\Controllers\Api\Custom\V1\chat;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ApiVersionControl as Version;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\Custom\V1\chat\Model\ChatApiModel as Model;


class ChatApi extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $model;
    public $env;

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
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
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
           $query=DB::table("prosystem_api_custom_test")
                            ->select($this->config->select())
                            ->where(function ($query)
                            {
                               foreach ($this->config->where() as $key=>$value)
                               {
                                   if(is_array($value))
                                   {
                                      $query->whereIn($key,$value);
                                   }
                                   else
                                   {
                                      $query->where($key,"=",$value);
                                   }

                               }
                            })
                            ->orderBy("id","desc")
                            ->skip($this->config->pageNumber())
                            ->take(1)
                            ->get();

           //output send
           return $this->config->output($query);

        });
    }



}
