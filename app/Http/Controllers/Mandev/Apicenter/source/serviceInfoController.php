<?php

namespace App\Http\Controllers\Mandev\Apicenter\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Apicenter\apicenterModel;
use DB;

class serviceInfoController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='apicenter';
    public $model;
    public $tsql;
    public $tdata;

    public function __construct (Request $request,apicenterModel $model)
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
        //app tsql
        $this->tsql=app("\Tsql");


    }

    public function getList()
    {
        return 'service Info';
    }
}
