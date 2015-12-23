<?php

namespace App\Http\Controllers\Mandev\LockScreen;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class lockScreenController extends Controller
{
    public $request;
    public $app;
    public $data=[];
    public $post;
    public $admin;

    public function __construct (Request $request)
    {
        $this->middleware('adminLock');
        $this->request=$request;
        $this->app=app()->make("Base");
        $this->admin=$this->app->admin();
        $this->data=$this->app->getLang(['url_path'=>'lockScreen','lang'=>$this->admin->lang]);

    }

    public function getIndex ()
    {
        //get admin for lockScreen false redirect login
        if($this->app->get_admin_for_lockScreen()==false) return redirect (''.strtolower(config("app.admin_dirname")).'/login');

        //get admin for lockScreen true
        $this->data['locked_admin']=$this->app->get_admin_for_lockScreen()[0];

        //return view for lockScreen
        return view("".config("app.admin_dirname").".lockScreen.main",$this->data);
    }

    public function postIndex()
    {
        //again login post true
        if(count($this->app->loginPost($_POST)))
        {
            //update user_lock together with user hash
            if(count($this->app->updateUserHash(Session("userHash"),$this->app->get_admin_for_lockScreen()[0]->id)))
            {
                //redirect home
                return redirect("".strtolower(config("app.admin_dirname"))."/home");
            }

            //if false update user hash
            return redirect("".strtolower(config("app.admin_dirname"))."/login");

        }

        //again login post false
        return redirect("".strtolower(config("app.admin_dirname"))."/login");
    }
}
