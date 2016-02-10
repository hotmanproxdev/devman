<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ControllerApi as apiController;
use App\Http\Controllers\Api\ModelApi as apiModel;

class ServicesApi extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $model;

    public function __construct (Request $request,apiController $controller,apiModel $model)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get api controller
        $this->controller=$controller;
        //get service name models
        $this->model=$model;

    }



    public function index ($serviceName=false)
    {
        //services control
        if(in_array($serviceName,$this->controller->services()))
        {
            //just developer ['select mode']
            if($this->request->header("codingRequest")==false)
            {
                //developer get info
                $developer=$this->controller->developer(Session("apiHash"));

                //developer true
                if($developer['success'])
                {
                    //test mode
                    if($serviceName=="test")
                    {
                        //test mode call
                        return $this->testRequest($developer['user']);
                    }

                    //access services
                    if(count($developer['access_services']))
                    {
                        if(!in_array($serviceName,$developer['access_services']))
                        {
                            //developer false
                            return response()->json(['success'=>false,
                                'msg'=>'you are not authorized for this service access'
                            ]);
                        }
                    }


                    //forbidden access services
                    if(count($developer['forbidden_access_services']))
                    {
                        if(in_array($serviceName,$developer['forbidden_access_services']))
                        {
                            //developer false
                            return response()->json(['success'=>false,
                                'msg'=>'you are not authorized for this service access'
                            ]);
                        }
                    }

                    //service call
                    return $this->model->get($serviceName,['codingRequest'=>false,'apiId'=>$developer['apiId'],'user'=>$developer['user']]);
                }

                //developer false
                return response()->json(['success'=>false,
                    'msg'=>$developer['msg']
                ]);
            }

            //developer coding mode (header obligatory)
            if($this->request->header("codingRequest")==true)
            {
                //coding control
                $coding=$this->controller->coding($this->request->header("hash"));

                //coding headers true
                if($coding['success'])
                {
                    //test mode
                    if($serviceName=="test")
                    {
                        if($this->request->header('Postman-Token'))
                        {
                            //developer coding header false
                            return 'You dont have any permission for data access from out source';
                        }

                        //test mode call
                        return $this->testRequest($coding['user']);
                    }

                    //out source forbidden (like postman)
                    if($this->request->header('Postman-Token'))
                    {
                        //developer coding header false
                        return 'You dont have any permission for data access from out source';
                    }

                    //service call
                    return $this->model->get($serviceName,['codingRequest'=>1,'apiId'=>$coding['apiId']]);
                }

                //developer coding header false
                return response()->json(['success'=>false,
                    'msg'=>$coding['msg']
                ]);
            }

        }

        //developer api false
        return response()->json(['success'=>false,
                'msg'=>'invalid service name'
               ]);
    }


    public function testRequest($apiuser)
    {
        //general servicess
        $services=$this->controller->services();

        //authorized access services
        if($apiuser[0]->access_services!==NULL)
        {
            $test=['test'];
            $access_service=explode("-",$apiuser[0]->access_services);
            $services=array_merge($test,$access_service);
        }

        //authorized forbidden access services
        if($apiuser[0]->forbidden_access_services!==NULL)
        {
            $test=[];
            $forbidden_access_service=explode("-",$apiuser[0]->forbidden_access_services);
            foreach ($services as $servicenames)
            {
                if(!in_array($servicenames,$forbidden_access_service))
                {
                    $serviceNames[]=$servicenames;
                }

            }
            $services=array_merge($test,$serviceNames);
        }
        $json_content=[
                       'success'=>true,
                       'ccode'=>$apiuser[0]->ccode,
                       'apikey'=>$apiuser[0]->apikey,
                       'standart_key'=>$apiuser[0]->standart_key,
                       'ip'=>$this->request->ip(),
                       'aim'=>'select-develop',
                       'hash'=>Session("apiHash"),
                       'services'=>$services,
                       'select'=>$this->request->header("select"),
                       'update'=>$this->request->header("update")
                       ];

        if($json_content['select']!==NULL)
        {
            $selectMode=json_decode($json_content['select'],true);
            foreach ($json_content as $key=>$content)
            {
                if(in_array($key,$selectMode))
                {
                    $select_json[$key]=$content;
                }
            }

            $json_content=$select_json;
        }


        //api developer
        return response()->json($json_content);
    }
}
