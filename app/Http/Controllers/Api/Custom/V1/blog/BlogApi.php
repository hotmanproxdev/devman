<?php

namespace App\Http\Controllers\Api\Custom\V1\blog;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ApiVersionControl as Version;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class BlogApi extends Controller implements \App\Http\Controllers\Api\InterfaceApi
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
        //version control
        $this->versionControl=$versionControl;
        //get config
        $this->config=$config;
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
        //get Base
        $this->base=$base;
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
        /**
        * @versionControl accessable version
        * @param version control obligatory
        * @param back log and statistics
        */
        return $this->versionControl->get([__CLASS__,__METHOD__],function()
        {
           /**
           * @param env environment api walker
           * @model api model default get run
           */
           $query=$this->env->model()->run();

           /**
           * @config api default settings
           * @output json,xml,soap converter
           */
           return $this->config->output($query);

        });
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Update Method
    |--------------------------------------------------------------------------
    |
    | Here is where you can update service of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function update ()
    {
        /**
        * @versionControl accessable version
        * @param version control obligatory
        * @param back log and statistics
        */
        return $this->versionControl->get([__CLASS__,__METHOD__],function()
        {
            /**
            * @param env environment api walker
            * @model api model default get run
            */
            $query=$this->env->model()->get("update")->run();

            /**
            * @config api default settings
            * @output json,xml,soap converter
            */
            return $this->config->output($query);

        },['provision'=>'postProvision']);
    }



    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Insert Method
    |--------------------------------------------------------------------------
    |
    | Here is where you can insert service of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function insert ()
    {
        /**
        * @versionControl accessable version
        * @param version control obligatory
        * @param back log and statistics
        */
        return $this->versionControl->get([__CLASS__,__METHOD__],function()
        {
            /**
            * @param env environment api walker
            * @model api model default get run
            */
            $query=$this->env->model()->get("insert")->run();

            /**
            * @config api default settings
            * @output json,xml,soap converter
            */
            return $this->config->output($query);

        },['provision'=>'postProvision']);
    }


    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Delete Method
    |--------------------------------------------------------------------------
    |
    | Here is where you can delete service of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function delete ()
    {
        /**
        * @versionControl accessable version
        * @param version control obligatory
        * @param back log and statistics
        */
        return $this->versionControl->get([__CLASS__,__METHOD__],function()
        {
            /**
            * @param env environment api walker
            * @model api model default get run
            */
            $query=$this->env->model()->get("delete")->run();

            /**
            * @config api default settings
            * @output json,xml,soap converter
            */
            return $this->config->output($query);

        },['provision'=>'postProvision']);
    }




}
