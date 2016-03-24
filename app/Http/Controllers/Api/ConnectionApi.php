<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

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
            $apiQuery=DB::table($this->app->dbTable(['api']))->where("ccode","=",config("app.api_ccode"))->where("ip","=",$this->request->ip())->where("apikey","=",$apikey)->get();

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
                'hash'=>'nohash'
            ]);

        }


        //develop query
        $develop=DB::table($this->app->dbTable(['api']))->where("ccode","=",config("app.api_ccode"))->where("apikey","=",$apikey);
        $getDev=$develop->get();


        if(count($getDev))
        {
            //hash generate
            $hash=$this->app->getApiHash(['ccode'=>$ccode,'ip'=>$this->request->ip(),'key'=>$apikey]);

            //hash number reset
            if(date("Ymd",$getDev[0]->created_at)<date("Ymd"))
            {
                if($getDev[0]->service_request_number!==NULL)
                {
                    $service_request_number=json_decode($getDev[0]->service_request_number,true);
                    foreach ($service_request_number as $skey=>$sval)
                    {
                        $update_service_request_number[$skey]=0;
                    }

                    $develop->update(['created_at'=>time(),'hash'=>$hash,'standart_key'=>$this->app->getApiStandartKey($getDev[0]->id),'hash_number'=>0,'request_number'=>0,
                    'service_request_number'=>json_encode($update_service_request_number)]);
                }
                else
                {
                    $develop->update(['created_at'=>time(),'hash'=>$hash,'standart_key'=>$this->app->getApiStandartKey($getDev[0]->id),'hash_number'=>0,'request_number'=>0]);
                }


                $develop=DB::table($this->app->dbTable(['api']))->where("apikey","=",$apikey);
                $getDev=$develop->get();
            }

            //hash number limit
            if($getDev[0]->hash_number<$getDev[0]->hash_limit)
            {
                //developer api register
                if($develop->update(['created_at'=>time(),'hash'=>$hash,'standart_key'=>$this->app->getApiStandartKey($getDev[0]->id),'hash_number'=>DB::raw('hash_number+1')]))
                {
                    //session initialize
                    Session::put("apiHash",$hash);

                    //api developer
                    return response()->json([
                        'success'=>true,
                        'ccode'=>$ccode,
                        'ip'=>$this->request->ip(),
                        'apikey'=>$apikey,
                        'aim'=>'developer',
                        'created_at'=>time(),
                        'hash'=>$hash
                        //'standart_key'=>$this->app->getApiStandartKey($getDev[0]->id)
                    ]);
                }
            }


            if($getDev[0]->hash!="nohash")
            {
                //developer api register
                if($develop->update(['created_at'=>time(),'hash'=>'nohash']))
                {
                    //return json false
                    return response()->json([
                        'success' => false,
                        'ccode' => $ccode,
                        'ip' => $this->request->ip(),
                        'apikey' => $apikey,
                        'aim' => 'developer',
                        'hash' => 'nohash',
                        'msg' => 'hash limit excess'
                    ]);

                }
            }

            //return json false
            return response()->json([
                'success' => false,
                'msg'=>'hash limit excess'
            ]);

        }


        //return json false
        return response()->json([
            'success' => false,
            'msg'=>'api key false'
        ]);



    }
}
