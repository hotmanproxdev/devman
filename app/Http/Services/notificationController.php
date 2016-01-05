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
    public $position;

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
        $this->position=array("success"=>"top-full-width","warning"=>"top-right");
    }

    public function success($data=array())
    {
        //predefined values
        $data['function']='success';
        $data['position']=$this->position['success'];

        //log info update
        $this->app->updateLogInfo($this->admin->id,['msg'=>$data['msg']]);

        //return view
        return view("".config("app.admin_dirname").".notification",$data);
    }


    public function warning($data=array())
    {
        //predefined values
        $data['function']='warning';
        $data['position']=$this->position['warning'];

        //log info update
        $this->app->updateLogInfo($this->admin->id,['msg'=>$data['msg']]);

        //return view
        return view("".config("app.admin_dirname").".notification",$data);
    }

}
