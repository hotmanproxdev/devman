<?php

namespace App\Http\Controllers\Mandev\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Api\apiModel;
use DB;
use Validation;
use Notification;
use Input;

class apiController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='api';
        public $model;
        public $validation;
        public $notification;

        public function __construct (Request $request,apiModel $model,Validation $validation,Notification $notification)
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
             //menu statu
             $this->data['menu']=$this->app->menuStatu('normal');
             //page role
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);
             //admin view
             $this->data['admin']=$this->admin;
             //get model
             $this->model=$model;
             //get validation
             $this->validation=$validation;
             //get notifications
             $this->notification=$notification;

        }

    public function getIndex ()
    {
        //return app("\Api")->get(['service'=>'getSameIpUsers'],'7d40c8cdfa699c26138080090c09a678');

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }

    public function getTest()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".apitest",[]);
    }

    public function getAutocomplete()
    {
        return app("\Autocomplete")->get();
    }
}
