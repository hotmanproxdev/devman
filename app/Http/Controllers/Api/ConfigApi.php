<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ConfigApi extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $model;
    public $version='V1'; //ucfirst
    public $cacheStatu=true;
    public $user_agent='Symfony/2.X';

    public function __construct(Request $request)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
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

    public function get()
    {
        return [];
    }

    /*
   |--------------------------------------------------------------------------
   | Application Api Custom table Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can find db table name of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function table ($table)
    {
        return $this->app->dbTable([$table]);
    }

    /*
   |--------------------------------------------------------------------------
   | Application Api Custom select Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can see header select for client in an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function select()
    {
        //example : ["id","username"]
        if($this->request->header("select"))
        {
            return json_decode($this->request->header("select"),true);
        }


        return '*';
    }

    /*
   |--------------------------------------------------------------------------
   | Application Api Custom subselect Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can register subselect on queries of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function subSelect()
    {
        if($this->request->header("select"))
        {
            return implode(",",json_decode($this->request->header("select"),true));
        }

        return '*';
    }

    /*
   |--------------------------------------------------------------------------
   | Application Api Custom where Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can register 'where queries' of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function where()
    {
        // example : {"id" : 1}
        if($this->request->header("where"))
        {
            return json_decode($this->request->header("where"),true);
        }


        return [];
    }


    /*
   |--------------------------------------------------------------------------
   | Application Api Custom update Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can register 'update quety' of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function update()
    {
        if($this->request->header("update"))
        {
            return json_decode($this->request->header("update"),true);
        }

        return [];
    }


    /*
   |--------------------------------------------------------------------------
   | Application Api Custom pagenumber Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can register pagination of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function pageNumber()
    {
        if($this->request->header("pageNumber"))
        {
            return $this->request->header("pageNumber")-1;
        }

        return 0;
    }

    /*
   |--------------------------------------------------------------------------
   | Application Api Custom postdata Method
   |--------------------------------------------------------------------------
   |
   | Here is where you can register posting of the api for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function postdata()
    {
        return $this->app->getvalidPostKey(json_decode($this->request->header("postdata"),1),['_token']);
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

    public function output($query)
    {
        if(count($query) && $query)
        {
             /**
             * @apref api reference control
             * @mission it truncates just once api reference table
             */
             Session::put("apref",false);

             /**
             * @result App $result
             * @mission success true array
             */
             $result=['success'=>true,'query'=>$query];
        }
        else
        {
             /**
             * @result App $result
             * @mission success false array
             */
             $result=['success'=>false,'query'=>[]];
        }

         /**
         * @return App $return
         * @mission return json object
         */
         return response()->json($result);
    }



}