<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ModelApi extends Controller
{

    public $request;
    public $app;

    public function __construct (Request $request)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");

    }


    public function get ($serviceName,$coding=array())
    {


        if(array_key_exists($serviceName,$this->app->dbTable(['all'])))
        {
            if(count(\Input::all()) and !array_key_exists("key",\Input::all()) and !array_key_exists("hash",\Input::all()))
            {
                if(!array_key_exists("where",\Input::all()))
                {
                    return abort("404");
                }

                if($coding['user'][0]->api_develop_url_filter==false)
                {
                    return ['success'=>false,'msg'=>'you dont have api developer url filter'];
                }

                //url filter
                $where=explode("/",\Input::get("where"));

                //select mode
                $call=DB::table($this->app->dbTable([$serviceName]))->where($where[0],'=',$where[1])->orderBy("id","desc")->paginate(config("app.api_paginator"));

                $apikey=\DB::table($this->app->dbTable(['api']))
                    ->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"))
                    ->get();

                if(count($apikey))
                {
                    $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['query'=>'table_access']);
                }

                return $call;
            }

            //select mode
            $call=DB::table($this->app->dbTable([$serviceName]))->orderBy("id","desc")->paginate(config("app.api_paginator"));

            $apikey=\DB::table($this->app->dbTable(['api']))
                ->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"))
                ->get();

            if(count($apikey))
            {
                $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['query'=>'table_access']);
            }

            return $call;

        }
        else
        {
            if($this->customApiCheck($serviceName,$coding['apiId']))
            {
                $customcontrol=DB::table($this->app->dbTable(['api_custom']))->
                where("custom_models","=",$serviceName)
                    ->where("statu","=",1)->orderBy("id","asc")->take(1)->get();

                if(count($customcontrol))
                {
                    if($customcontrol[0]->custom_dir==NULL)
                    {
                        //service call
                        $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';
                    }
                    else
                    {
                        //service call
                        $serviceName='App\Http\Controllers\Api\Custom\\'.str_replace("/","\\",$customcontrol[0]->custom_dir).'\\'.ucfirst($serviceName).'Api';
                    }

                }



                //default
                $method='get';

                //url filter method
                if(count(\Input::all()))
                {
                    //method exists
                    if(method_exists($serviceName,\Input::get("method")))
                    {
                        $method=\Input::get("method");
                    }
                }

                return App($serviceName)->$method();

            }

            return ['success'=>false,'msg'=>'you dont have service access'];

        }

    }

    public function customApiCheck($serviceName,$user)
    {
        $customModel=DB::table($this->app->dbTable(['api']))->where("id","=",$user)->get();

        if(count($customModel))
        {
            $custom_access=explode("-",$customModel[0]->access_services);

            if($customModel[0]->forbidden_access_services!==NULL)
            {
                $forbidden_custom_access=explode("-",$customModel[0]->forbidden_access_services);

                if(in_array($serviceName,$forbidden_custom_access))
                {
                    return false;
                }
            }
            if((in_array($serviceName,$custom_access)) OR ($customModel[0]->access_services==NULL))
            {
                return true;
            }
            return false;
        }

        return false;
    }


}
