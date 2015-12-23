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
       public $url_path='home';

       public function __construct (Request $request)
       {
           //request class
           $this->request=$request;
           //base service provider
           $this->app=app()->make("Base");
           //base url assing
           $this->data['baseUrl']='http://'.$this->request->getHttpHost().''.$this->request->getBaseUrl().'';
       }

    public function index ()
    {
        //return view
        return 'hello world';
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }
}
