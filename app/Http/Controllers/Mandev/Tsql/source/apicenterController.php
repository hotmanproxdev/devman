<?php

namespace App\Http\Controllers\Mandev\Tsql\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Tsql\tsqlModel;
use DB;

class apicenterController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='tsql';
    public $model;

    public function __construct (Request $request,tsqlModel $model)
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

    public function get()
    {
        return 'source';
    }
}
