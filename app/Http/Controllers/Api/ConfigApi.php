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
    public $pageNumber=10;

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

    public function select($data=false)
    {
        if($data)
        {
            if(array_key_exists("select",$data['headers']))
            {
                if($data['headers']['select'])
                {
                    return $data['headers']['select'];
                }
                return '*';
            }
            else
            {
                return '*';
            }


        }
        else
        {
            //example : ["id","username"]
            if($this->request->header("select"))
            {
                return json_decode($this->request->header("select"),true);
            }

            return '*';
        }




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

    public function where($data=false)
    {
        if($data)
        {
            if(array_key_exists("where",$data['headers']))
            {
                if($data['headers']['where'])
                {
                    return $data['headers']['where'];
                }

                return [];
            }
            else
            {
                return [];
            }



        }
        else
        {
            // example : {"id" : 1}
            if($this->request->header("where"))
            {
                return json_decode($this->request->header("where"),true);
            }
        }


        return [];
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

    public function whereOpt($key=false)
    {
        // example : {"id" : ">"}
        if($this->request->header("whereOpt"))
        {
            $optar=json_decode($this->request->header("whereOpt"),true);
            if(array_key_exists($key,$optar))
            {
                return $optar[$key];
            }
            else
            {
                return "=";
            }
        }

        return "=";
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

    public function update($data=false)
    {
        if($data)
        {
            if($data['headers']['update'])
            {
                return $data['headers']['update'];
            }

            return [];
        }
        else
        {
            if($this->request->header("postdata"))
            {
                return json_decode($this->request->header("postdata"),true);
            }

            return [];
        }

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
  | Application Api Custom take data
  |--------------------------------------------------------------------------
  |
  | Here is where you can register pagination of the api for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
  */

    public function take($data=false)
    {
        if($data)
        {
            if(array_key_exists("take",$data['headers']))
            {
                if($data['headers']['take'])
                {
                    return $data['headers']['take'];
                }

                return $this->pageNumber;
            }

            return $this->pageNumber;

        }
        else
        {
            if($this->request->header("take"))
            {
                return $this->request->header("take");
            }

            return $this->pageNumber;
        }

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

    public function postdata($data=false)
    {
        if($data)
        {
            if($data['headers']['insert'])
            {
                return $data['headers']['insert'];
            }

            return [];
        }
        else
        {
            return $this->app->getvalidPostKey(json_decode($this->request->header("postdata"),1),['_token']);
        }

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