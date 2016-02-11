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
                Session::forget('apiHash');
                //developer get info
                if(Session("apiHash"))
                {
                    $developer=$this->controller->developer(Session("apiHash"));
                }
                else
                {
                    $developer=$this->controller->guest();
                }


                //developer true
                if($developer['success'])
                {

                //services except test
                if($serviceName!=="test")
                {
                    //limit condition
                    if($developer['user'][0]->request_type)
                    {
                        $service_request_number=json_decode($developer['user'][0]->service_request_number,true);

                        if(array_key_exists($serviceName,$service_request_number))
                        {
                            if($developer['user'][0]->request<$service_request_number[$serviceName]+1)
                            {
                                //developer false
                                return response()->json(['success'=>false,
                                    'msg'=>'you have limit timeout for this service'
                                ]);
                            }
                        }

                    }
                    else
                    {
                        if($developer['user'][0]->request<$developer['user'][0]->request_number+1)
                        {
                            //developer false
                            return response()->json(['success'=>false,
                                'msg'=>'you have limit timeout for all service total limit right'
                            ]);
                        }
                    }
                }

                //user request register
                $this->controller->userRequest(['service'=>$serviceName,'user'=>$developer['user']]);


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
            $services=json_encode(array_merge($test,$access_service));
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
            $services=json_encode(array_merge($test,$serviceNames));
        }
        $json_content=[
                       'success'=>true,
                       'static'=>
                           [
                           'ip'=>$this->request->ip(),
                           'aim'=>'select-develop',
                           'hash'=>Session("apiHash"),
                           'ccode'=>$apiuser[0]->ccode,
                           'apikey'=>$apiuser[0]->apikey,
                           'standart_key'=>$apiuser[0]->standart_key
                           ],
                       'request'=>
                          [
                           'daily_request_limit'=>$apiuser[0]->request,
                           'service_number_requested_user_today'=>$apiuser[0]->request_number,
                           'service_number_requested_user_all'=>$apiuser[0]->all_request_number,
                           'request_type'=>$apiuser[0]->request_type,
                           'today_service_request_json'=>json_decode($apiuser[0]->service_request_number,true),
                           'all_service_request_json'=>json_decode($apiuser[0]->all_service_request_number,true)
                           ],
                       'api'=>
                           [
                           'access_services'=>$services,
                               'forbidden_access_services'=>json_encode(explode("-",$apiuser[0]->forbidden_access_services),true),
                           'select'=>$this->request->header("select"),
                           'update'=>$this->request->header("update")
                           ]
                       ];

        if($json_content['api']['select']!==NULL)
        {
            $selectMode=json_decode($json_content['api']['select'],true);
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
