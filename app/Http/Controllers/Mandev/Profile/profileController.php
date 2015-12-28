<?php

namespace App\Http\Controllers\Mandev\Profile;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Profile\profileModel;
use DB;

class profileController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='profile';
        public $model;

        public function __construct (Request $request,profileModel $model)
        {
             //page protector
             $this->middleware('auth');
             //request class
             $this->request=$request;
             //base service provider
             $this->app=app()->make("Base");
             //page lang
             $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>1]);
             //menu statu
             $this->data['menu']=$this->app->menuStatu('normal');
             //admin data
             $this->admin=$this->app->admin();
             //admin data passing
             $this->data['admin']=$this->admin;
             //page role
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin->role]);
             //get page model
             $this->model=$model;

        }

    public function getIndex ()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }

    public function postIndex()
    {
        return $this->model->updateProfile($_POST);
    }
}
