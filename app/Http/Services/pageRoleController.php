<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Notification;

class pageRoleController extends Controller
{

    public $request;
    public $notification;
    public $app;
    public $data;

    public function __construct(Request $request,Notification $notification)
    {
        //page protector
        $this->middleware('auth');
        //request method
        $this->request=$request;
        //notification method
        $this->notification=$notification;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function get($role,$callback)
    {
        $val=false;

        //null true
        if($this->admin->system_number==0)
        {
            $val=true;
        }

        //get user Role
        $userRole=explode("@",$this->admin->role);

        if(in_array($role,$userRole))
        {
            $val=true;
        }

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        $fail=0;

        if(array_key_exists("_token",\Input::all()))
        {
            $fail=1;
        }

        //redirect to logout
        \DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['noauth_area_operations'=>\DB::raw('noauth_area_operations+1')]);
        \DB::table($this->app->dbTable(['logs']))->where("userid","=",$this->admin->id)->where("userHash","=",$this->admin->hash)->orderBy("id","desc")->
        take(1)->update(['url_path_valid'=>0,'noauth_area_operations'=>1,'fail_operations'=>$fail,'msg'=>$this->data['no_role_page']]);


        //redirect to logout
        dd($this->data['no_role_page']);


    }


    public function table($role,$callback)
    {
        $val=false;

        //null true
        if($this->admin->system_number==0)
        {
            $val=true;
        }

        //get user Role
        $userRole=explode("@",$this->admin->role);

        if(in_array($role,$userRole))
        {
            $val=true;
        }

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }


       return false;


    }
}
