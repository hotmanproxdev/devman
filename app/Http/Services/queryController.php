<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Notification;

class queryController extends Controller
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

    public function isCountTrue($data=array(),$callback)
    {
        $val=false;

        if(count($data))
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

        //redirect to logout
        $this->notification->manipulation(['msg'=>$this->data['manipulation'],'title'=>$this->data['error']]);

        //redirect to logout
        dd($this->data['manipulation']);


    }

    public function isTrue($data,$callback)
    {
        $val=false;

        if($data)
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

        //redirect to logout
        return $this->notification->warning(['msg'=>$this->data['warning_info'],'title'=>$this->data['error']]);

    }


    public function getLogUpdated($data=array(),$callback)
    {
        $val=false;

        if(count($data))
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

        //redirect to logout
        return $this->notification->warning(['msg'=>$this->data['warning_info'],'title'=>$this->data['error']]);

    }
}
