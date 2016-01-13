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
        //page protector
        $this->middleware('auth');
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
    }

    public function index()
    {
        if(Session("userHash"))
        {
            if(DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['logout'=>1,'logout_time'=>time()]))
            {
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
