<?php

namespace App\Http\Controllers\Mandev\Login;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

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
       }

    public function getIndex ()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }

    public function postIndex()
    {
        //get hash password
        $_POST['password']=$this->app->passwordHash($_POST['password']);

        //login post value from db
        $loginPost=$this->app->loginPost($_POST);

        //true login post
        if(count($loginPost))
        {
            //get session hash info
            $sessionHash=$this->app->loginSessionHash($loginPost);

            //update hash, if it is true
            if($this->app->updateUserHash($sessionHash,$loginPost[0]->id))
            {
                Session::put("userHash",$sessionHash);
                return redirect("".strtolower(config("app.admin_dirname"))."/home");
            }

            //give this warning when data hasn't been updated hash
            return response()->json(['warning'=>config("app.login_warning")]);
        }

        //return false
        return redirect("".strtolower(config("app.admin_dirname"))."/login");

    }



}
