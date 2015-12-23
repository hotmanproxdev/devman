<?php

namespace App\Http\Controllers\Mandev\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;

class homeController extends Controller
{
       public $request;
       public $app;
       public $data;
       public $admin;
       public $url_path='home';

       public function __construct (Request $request)
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

       }

    public function index ()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }
}
