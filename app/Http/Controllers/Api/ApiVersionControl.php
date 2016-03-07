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


    public function get($namespace=array(),$callback)
    {
        $getMethod=explode("::",$namespace[1]);

        $val=false;

        if(preg_match('@\bV(\d+)\b@is',$namespace[0],$array))
        {
            if($array[1]>1)
            {
                $val=true;
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
                                    return app($iclass)->$getMethod[1]();
                                }

                                return response()->json(['success'=>false,'msg'=>'the requested version number is not prepared yet']);

                            }

                        }
                        else
                        {
                            if($this->version=="V1")
                            {
                                $val=true;
                            }
                            else
                            {
                                return app($class)->$getMethod[1]();
                            }
                        }

                    }
                    else
                    {
                        return response()->json(['success'=>false,'msg'=>'the requested version number is not prepared yet']);
                    }
                }
                else
                {
                    $class=preg_replace('@V(\d+)@is',''.$this->request->header("version").'',$namespace[0]);

                    if(class_exists($class))
                    {
                        if($this->version==$this->request->header("version"))
                        {
                            $val=true;
                        }
                        else
                        {
                            return app($class)->$getMethod[1]();
                        }
                    }
                    else
                    {
                        return response()->json(['success'=>false,'msg'=>'the requested version number is not prepared yet']);
                    }

                }
            }
        }




        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }
    }

}