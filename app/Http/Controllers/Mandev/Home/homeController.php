<?php

namespace App\Http\Controllers\Mandev\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Time;

class homeController extends Controller
{
       public $request;
       public $app;
       public $data;
       public $admin;
       public $url_path='home';
       public $time;

       public function __construct (Request $request,Time $time)
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
           //time def
           $this->time=$time;

       }

    public function index ()
    {
        $img=\Image::make('http://localhost:8070/projects/devman/devman/public/upload/admin_profil_pictures/48832.jpg')->resize(100,100);
        return $img->response('jpg');
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }
}
