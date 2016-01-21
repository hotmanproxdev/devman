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
        if(count($coding)>0)
        {
            if($coding['codingRequest'])
            {
                //update mode
                if($this->request->header("update")!==NULL)
                {
                    $update=json_decode($this->request->header("update"),true);
                    if(DB::table($this->app->dbTable([$serviceName]))->whereRaw($update['where'][0],$update['where'][1])->update($update['select']))
                    {
                        return DB::table($this->app->dbTable([$serviceName]))->orderBy("id","desc")->paginate(config("app.api_paginator"));
                    }
                }

                //default mode
                if($this->request->header("select")==NULL)
                {
                    if(array_key_exists($serviceName,$this->app->dbTable(['all'])))
                    {
                        return DB::table($this->app->dbTable([$serviceName]))->orderBy("id", "desc")->paginate(config("app.api_paginator"));
                    }
                    else
                    {
                        $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';
                        return App($serviceName)->get();
                    }
                }

                if(array_key_exists($serviceName,$this->app->dbTable(['all'])))
                {
                    //select mode
                    return DB::table($this->app->dbTable([$serviceName]))->select(json_decode($this->request->header("select"), true))->orderBy("id", "desc")->paginate(config("app.api_paginator"));
                }
                else
                {
                    $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';
                    return App($serviceName)->get();
                }


            }

        }

        if(array_key_exists($serviceName,$this->app->dbTable(['all'])))
        {
            //select mode
            return DB::table($this->app->dbTable([$serviceName]))->orderBy("id","desc")->paginate(config("app.api_paginator"));
        }
        else
        {
            $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';
            return App($serviceName)->get();

        }

    }


}
