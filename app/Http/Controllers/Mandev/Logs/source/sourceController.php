<?php

namespace App\Http\Controllers\Mandev\Logs\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Logs\logsModel;
use DB;

class sourceController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='default';
    public $model;
    public $sourcedata=array("class"=>__NAMESPACE__);

    public function __construct (Request $request,logsModel $model)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>$this->admin->lang]);
        //admin view
        $this->data['admin']=$this->admin;
        //get model
        $this->model=$model;


    }

    public function data ($data=false)
    {
       if($data)
       {
           $this->sourcedata['data']=$data;
       }

        return $this;
    }

    public function get($data=false)
    {
        if($data)
        {
            $this->sourcedata['method']=$data;
        }

        $callNameSpace='\\'.$this->sourcedata['class'].'\\'.$this->sourcedata['data'].'Controller';
        $method=$this->sourcedata['method'];
        return app($callNameSpace)->$method();
    }


}
