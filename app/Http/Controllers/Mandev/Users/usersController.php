<?php

namespace App\Http\Controllers\Mandev\Users;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Users\usersModel;
use DB;

class usersController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='users';
        public $model;
        public $pagination;

        public function __construct (Request $request,usersModel $model)
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
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>2,'admin'=>$this->admin->role]);
             //get model
             $this->model=$model;

        }

    public function getIndex ()
    {
        //get all users
        $this->data['getUsers']=$this->model->getUsers();

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }


    public function getNewuser()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".newUser",$this->data);
    }

    public function postNewuser()
    {
        //new user post
        dd($_POST);
    }
}
