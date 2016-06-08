<?php

namespace App\Http\Controllers\Mandev\Adminlog\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Adminlog\adminlogModel;
use DB;

class graphsController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='adminlog';
    public $model;
    public $tsql;
    public $tdata;
    public $api;

    public function __construct (Request $request,adminlogModel $model)
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
        //get api services
        $this->api=app("Api")->version(config("app.apiversion"));


    }

    public function column()
    {
        //column chart mounths data
        $mounths=['ocak'=>12,'subat'=>19,'mart'=>14,'nisan'=>22,'mayis'=>26,'haz.'=>32,'tem.'=>28,'agus.'=>41,'eylul'=>30,'ekim'=>24,'kasim'=>33,'aralik'=>30];

        //column chart
        return app("\Chart")->columnChart(['chart_number'=>[1],'data'=>[$mounths],'text'=>['testChart1']]);
    }
}
