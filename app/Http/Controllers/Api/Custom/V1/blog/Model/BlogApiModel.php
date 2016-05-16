<?php

namespace App\Http\Controllers\Api\Custom\V1\blog\Model;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class BlogApiModel extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $env;
    public $base;

    public function __construct (Request $request,Config $config,Base $base)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get config
        $this->config=$config;
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
        //get base
        $this->base=$base;

    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method Modelling
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function get ()
    {
       //make query
       return DB::table("prosystem_api_custom_test")
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
    }



     /*
     |--------------------------------------------------------------------------
     | Application Api Custom Get Method Update
     |--------------------------------------------------------------------------
     |
     | Here is where you can update service of the api for an application.
     | It's a breeze. Simply tell Laravel the URIs it should respond to
     | and give it the controller to call when that URI is requested.
     |
     */

     public function update ()
     {
        return app("\Transaction")->commit(function()
        {
            //make query
            return DB::table($this->app->dbTable(['admin']))
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
                    ->update($this->config->update());
            });

        }


     /*
     |--------------------------------------------------------------------------
     | Application Api Custom Get Method Insert
     |--------------------------------------------------------------------------
     |
     | Here is where you can insert service of the api for an application.
     | It's a breeze. Simply tell Laravel the URIs it should respond to
     | and give it the controller to call when that URI is requested.
     |
     */

     public function insert ()
     {
        return app("\Transaction")->commit(function()
        {
            //make query
            return DB::table($this->app->dbTable(['admin']))->insert($this->config->postdata());
        });

     }


     /*
     |--------------------------------------------------------------------------
     | Application Api Custom Get Method Delete
     |--------------------------------------------------------------------------
     |
     | Here is where you can delete service of the api for an application.
     | It's a breeze. Simply tell Laravel the URIs it should respond to
     | and give it the controller to call when that URI is requested.
     |
     */

     public function delete ()
     {
        return app("\Transaction")->commit(function()
        {
            //make query
            return DB::table($this->app->dbTable(['admin']))
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
                    ->delete();
            });

        }

}
