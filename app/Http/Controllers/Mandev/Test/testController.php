<?php

namespace App\Http\Controllers\Mandev\Test;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Test\testModel;
use DB;
use Validation;
use Notification;
use Input;

class testController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='test';
        public $model;
        public $validation;
        public $notification;

        public function __construct (Request $request,testModel $model,Validation $validation,Notification $notification)
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
        $this->data['linechart']=app("\Chart")->lineChart(['chart_number'=>[2,3],'data'=>[['a'=>2,'b'=>4,'c'=>1],['a'=>8,'b'=>3,'c'=>2]]]);

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }


    public function getModal()
    {
        $this->data['linechart']=app("\Chart")->lineChart(['chart_number'=>[4,5],'data'=>[['a'=>2,'b'=>4,'c'=>1],['a'=>8,'b'=>3,'c'=>2]]]);

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".modal",$this->data);
    }
}
