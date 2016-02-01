<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\Matcher\Not;
use Notification;
use Input;

class tokenController extends Controller
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

    public function valid($callback)
    {
        $val=true;

        if((Input::get("_token")==$this->admin->last_token) AND (base64_encode(json_encode(Input::all()))==$this->admin->last_post))
        {
            $val=false;
        }

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        //update profil false notification
        return $this->notification->warning(['msg'=>$this->data['token_invalid'],'title'=>$this->data['error']]);


    }
}
