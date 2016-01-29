<?php

namespace App\Http\Controllers\Mandev;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;

class logoutController extends Controller
{
    public $app;
    public $admin;

    public function __construct()
    {
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
    }

    public function index()
    {
        if(Session("userHash"))
        {
            $time_spent=time()-$this->admin->last_login_time;
            $all_time_spent=$this->admin->all_time_spent+$time_spent;

            if($this->admin->all_hash_number==0)
            {
                $all_average_time_spent_for_every_hash=0;
            }
            else
            {
                $all_average_time_spent_for_every_hash=$all_time_spent/$this->admin->all_hash_number;
            }

            if(DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['logout'=>1,'logout_time'=>time(),'all_time_spent'=>DB::raw('last_hash_time_spent+'.$time_spent),
            'hash_time_spent'=>$time_spent,'last_hash_time_spent'=>DB::raw('last_hash_time_spent+'.$time_spent),'all_average_time_spent_for_every_hash'=>$all_average_time_spent_for_every_hash]))
            {
                //temporary last hash
                Session::put("tempHash",$this->admin->last_hash);

                //session forget userhash
                Session::forget('userHash');

                //redirect to login
                return redirect("".strtolower(config("app.admin_dirname"))."/login");
            }
        }

            //redirect to login
            return redirect("".strtolower(config("app.admin_dirname"))."/login");

    }
}
