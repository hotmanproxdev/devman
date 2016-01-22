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
                        return $this->testRequest();
                    }
                    //service call
                    return $this->model->get($serviceName,['codingRequest'=>false,'apiId'=>$developer['apiId']]);
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
                        //test mode call
                        return $this->testRequest();
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


    public function testRequest()
    {
        $json_content=[
                       'success'=>true,
                       'ip'=>$this->request->ip(),
                       'aim'=>'developer',
                       'hash'=>Session("apiHash"),
                       'services'=>$this->controller->services(),
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
