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
       }

    public function index ()
    {
        //return view
        return $this->request->getHttpHost();
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }
}
