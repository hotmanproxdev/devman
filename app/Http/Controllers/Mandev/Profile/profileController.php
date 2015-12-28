<?php

namespace App\Http\Controllers\Mandev\Profile;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Profile\profileModel;
use DB;
use Input;

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
        //update profil for session admin
        return $this->model->updateProfile(Input::all());
    }

    public function postChangepassword()
    {
        //check new password and renew password
        if(Input::get("new_password")==Input::get("renew_password"))
        {
            return $this->model->changePassword(Input::all());
        }

    }
}
