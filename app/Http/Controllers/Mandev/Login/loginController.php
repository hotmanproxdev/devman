<?php

namespace App\Http\Controllers\Mandev\Login;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;

class loginController extends Controller
{
       public $request;
       public $app;
       public $data=[];
       public $url_path='login';

       public function __construct (Request $request)
       {
           //request class
           $this->request=$request;
           //base service provider
           $this->app=app()->make("Base");
           //page lang
           $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>1]);
           //base url assing
           $this->data['baseUrl']='http://'.$this->request->getHttpHost().''.$this->request->getBaseUrl().'';
       }

    public function index ()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }
}
