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
                        if($this->customApiCheck($serviceName,$coding['apiId']))
                        {
                            $method=$this->request->header("method");
                            $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';
                            return App($serviceName)->$method();
                        }

                        return ['success'=>false,'msg'=>'you dont have service access'];
                    }
                }

                if(array_key_exists($serviceName,$this->app->dbTable(['all'])))
                {
                    //select mode
                    return DB::table($this->app->dbTable([$serviceName]))->select(json_decode($this->request->header("select"), true))->orderBy("id", "desc")->paginate(config("app.api_paginator"));
                }
                else
                {
                    if($this->customApiCheck($serviceName,$coding['apiId']))
                    {
                        $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';

                        $method=$this->request->header('method');

                        return App($serviceName)->$method();

                    }

                    return ['success'=>false,'msg'=>'you dont have service access'];

                }


            }

        }

        if(array_key_exists($serviceName,$this->app->dbTable(['all'])))
        {
            if(count(\Input::all()))
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
                return DB::table($this->app->dbTable([$serviceName]))->where($where[0],'=',$where[1])->orderBy("id","desc")->paginate(config("app.api_paginator"));
            }

            //select mode
            return DB::table($this->app->dbTable([$serviceName]))->orderBy("id","desc")->paginate(config("app.api_paginator"));

        }
        else
        {
            if($this->customApiCheck($serviceName,$coding['apiId']))
            {
                //service call
                $serviceName='App\Http\Controllers\Api\Custom\\'.ucfirst($serviceName).'Api';

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
