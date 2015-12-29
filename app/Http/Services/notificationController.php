<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class notificationController extends Controller
{
    public $request;
    public $app;
    public $admin;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
    }

    public function send($data=array())
    {
        //predefined values
        $data['position']=(array_key_exists('position',$data)) ? $data['position'] : 'top-full-width';
        $data['function']=(array_key_exists('function',$data)) ? $data['function'] : 'success';

        //return view
        return view("".config("app.admin_dirname").".notification",$data);
    }

}
