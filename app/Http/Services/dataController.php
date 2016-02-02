<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\Matcher\Not;
use Notification;
use Input;

class dataController extends Controller
{
    public $notification;

    public function __construct(Notification $notification)
    {
        //page protector
        $this->middleware('auth');
        //notification
        $this->notification=$notification;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function control($data=array(),$callback)
    {

        if(count($data))
        {
            $query=\DB::table($this->app->dbTable([$data[0]]))->where("id","=",$data[1])->get();
            if(count($query))
            {
                if(is_callable($callback))
                {
                    return call_user_func($callback);
                }
            }

            //no user in database
            $this->app->updateLogInfo($this->admin->id,['msg'=>$this->data['noauth'],'noauth_area_operations'=>1,'manipulation'=>1]);
            return abort("404");

        }

    }
}
