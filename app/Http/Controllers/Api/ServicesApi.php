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
        if($serviceName=="test")
        {
            return $this->testRequest();
        }

        if(in_array($serviceName,$this->controller->services()))
        {
            if($this->controller->developer(Session("apiHash")))
            {
                return $this->model->$serviceName();
            }

            return response()->json(['success'=>false,
                'msg'=>'invalid api hash'
            ]);
        }

        return response()->json(['success'=>false,
                'msg'=>'invalid service name'
               ]);
    }


    public function testRequest()
    {
        //api developer
        return response()->json([
            'success'=>true,
            'ip'=>$this->request->ip(),
            'aim'=>'developer',
            'hash'=>Session("apiHash"),
            'services'=>$this->controller->services()
        ]);
    }
}
