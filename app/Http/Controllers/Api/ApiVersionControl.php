<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use Cache;
use App\Http\Controllers\Api\ConfigApi as Config;

class ApiVersionControl extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $model;
    public $version='V1'; //ucfirst
    public $env;
    public $provision;
    public $config;

    public function __construct(Request $request,Config $config)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
        //get provision
        $this->provision=$this->env->provision();
        //get config
        $this->config=$config;
    }


    public function get($namespace=array(),$callback,$data=array())
    {
        if(array_key_exists("access",$data) && !Session::has("mainSource") && !$data['access'])
        {
            return response()->json(['success'=>false,'msg'=>'No access']);
        }


        Session::forget("mainSource");

        if(!array_key_exists("provision",$data) && !$this->provision['success'] && !Session::has("testApi"))
        {
            return response()->json(['success'=>false,'msg'=>$this->provision['msg']]);
        }

        $apikey=\DB::table($this->app->dbTable(['api']))
            ->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"))
            ->get();

        $getMethod=explode("::",$namespace[1]);

        Session::put("apiWorkingMethod",$getMethod[1]);

        $val=false;

        if(preg_match('@\bV(\d+)\b@is',$namespace[0],$array))
        {
            if($array[1]>1)
            {
                $val=true;

                if(array_key_exists("method",\Input::all()))
                {
                    $methodic=explode("::",$namespace[1]);

                    if($methodic[1]=="get")
                    {
                        $iclass=preg_replace('@V(\d+)@is',''.ucfirst(\Input::get("version")).'',$namespace[0]);
                        $methodget=\Input::get("method");

                        if(method_exists(app($iclass),$methodget))
                        {
                            $call=app($iclass)->$methodget();
                            return $call;
                        }

                        if(count($apikey))
                        {
                            $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['msg'=>'The requested method is not valid']);
                        }

                        return response()->json(['success'=>false,'msg'=>'The requested method is not valid']);


                    }

                }
                else
                {
                    if(count($data))
                    {
                        if(count($apikey) && array_key_exists("auth",$data))
                        {
                            if($data['auth']!==$apikey[0]->ccode)
                            {
                                $val=false;
                            }
                        }
                    }
                }


            }
            else
            {
                if(!$this->request->header("version"))
                {
                    $class=preg_replace('@V(\d+)@is',''.$this->version.'',$namespace[0]);

                    if(class_exists($class))
                    {
                        if(array_key_exists("version",\Input::all()))
                        {
                            if(ucfirst(\Input::get("version"))=="V1")
                            {
                                return response()->json(['success'=>false,'msg'=>'V1 is default version,so you have to sent request other']);
                            }
                            else
                            {
                                $iclass=preg_replace('@V(\d+)@is',''.ucfirst(\Input::get("version")).'',$namespace[0]);


                                if(class_exists($iclass))
                                {
                                    $call=app($iclass)->$getMethod[1]();

                                    $callex=explode("{",$call);

                                    $call=str_replace($callex[0],"",$call);

                                    if(count($apikey))
                                    {
                                        $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['query'=>$call]);
                                    }
                                    return $call;
                                }

                                $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->
                                update(['msg'=>'the requested version number is not prepared yet']);

                                return response()->json(['success'=>false,'msg'=>'the requested version number is not prepared yet']);

                            }

                        }
                        else
                        {
                            if($this->version=="V1")
                            {
                                $val=true;

                                if(count($data))
                                {
                                    if(count($apikey) && array_key_exists("auth",$data))
                                    {
                                        if($data['auth']!==$apikey[0]->ccode)
                                        {
                                            $val=false;
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $call=app($class)->$getMethod[1]();

                                $callex=explode("{",$call);

                                $call=str_replace($callex[0],"",$call);

                                if(count($apikey))
                                {
                                    $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['query'=>$call]);
                                }

                                return $call;
                            }
                        }

                    }
                    else
                    {
                        $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->
                        update(['msg'=>'the requested version number is not prepared yet']);

                        return response()->json(['success'=>false,'msg'=>'the requested version number is not prepared yet']);
                    }
                }

            }
        }




        if($val)
        {
            if(is_callable($callback))
            {
                $call=call_user_func($callback);

                $callex=explode("{",$call);

                $call=str_replace($callex[0],"",$call);

                if(count($apikey))
                {
                    $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['query'=>$call]);
                }


                if(array_key_exists("cache",$data) && $this->config->cacheStatu)
                {

                    if(!($this->request->header("user-agent")==$this->config->user_agent))
                    {
                        return Cache::remember($namespace[1],$data['cache'], function() use ($call)
                        {
                            return $call;
                        });
                    }


                }

                if(array_key_exists("provision",$data) && !Session::has("testApi"))
                {
                    if(!is_array($data['provision']))
                    {

                        $provision=app("\App\Http\Controllers\Api\ProvisionApi")->$data['provision']();
                        if($provision['success']===false)
                        {
                            return response()->json(['success'=>false,'msg'=>$provision['msg']]);
                        }
                    }
                    else
                    {
                        if(!$data['provision']['success'])
                        {
                            return response()->json(['success'=>false,'msg'=>$data['provision']['msg']]);
                        }
                    }

                }

                return $call;



            }
        }


        if(count($apikey))
        {
            $lastlog=\DB::table($this->app->dbTable(['log_api']))->where("apikey","=",$apikey[0]->id)->orderBy("id","desc")->take(1)->update(['msg'=>'This service demands special access right']);
        }

        return response()->json(['success'=>false,'msg'=>'This service demands special access right']);
    }

}