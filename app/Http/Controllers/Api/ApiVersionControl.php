<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ApiVersionControl extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $model;
    public $version='V1'; //ucfirst

    public function __construct(Request $request)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
    }


    public function get($namespace=array(),$callback,$data=array())
    {

        $apikey=\DB::table($this->app->dbTable(['api']))
            ->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"))
            ->get();

        $getMethod=explode("::",$namespace[1]);

        $val=false;

        if(preg_match('@\bV(\d+)\b@is',$namespace[0],$array))
        {
            if($array[1]>1)
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