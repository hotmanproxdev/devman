<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Notification;

class ajaxController extends Controller
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

    public function control($callback)
    {
        $val=false;

        if($this->request->ajax())
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
        return $this->notification->manipulation(['msg'=>$this->data['manipulation'],'title'=>$this->data['error']]);


    }
}
