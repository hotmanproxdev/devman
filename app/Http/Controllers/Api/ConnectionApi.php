<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;

class ConnectionApi extends Controller
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

    public function index ($ccode=false,$apikey=false)
    {
        if(($ccode!=config("app.api_ccode")))
        {
            //api query
            $apiQuery=DB::table($this->app->dbTable(['api']))->where("ccode","=",$ccode)->where("ip","=",$this->request->ip())->where("apikey","=",$apikey)->where("statu","=",1)->get();

            if(count($apiQuery))
            {
                //return json true
                return response()->json([
                    'success'=>true,
                    'ccode'=>$ccode,
                    'ip'=>$this->request->ip(),
                    'apikey'=>$apikey,
                    'aim'=>'service',
                    'created_at'=>time(),
                    'hash'=>$this->app->getApiHash(['ccode'=>$ccode,'ip'=>$this->request->ip(),'key'=>$apikey])
                ]);
            }


            //return json false
            return response()->json([
                'success'=>false,
                'ccode'=>$ccode,
                'ip'=>$this->request->ip(),
                'apikey'=>$apikey,
                'aim'=>'service',
                'hash'=>false
            ]);

        }


        //api developer
        return response()->json([
            'success'=>true,
            'ccode'=>$ccode,
            'ip'=>$this->request->ip(),
            'apikey'=>$apikey,
            'aim'=>'developer',
            'created_at'=>time(),
            'hash'=>$this->app->getApiHash(['ccode'=>$ccode,'ip'=>$this->request->ip(),'key'=>$apikey])
        ]);

    }
}
