<?php

namespace App\Http\Controllers\Mandev\Profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class profileModel extends Controller
{
    public $request;
    public $app;
    public $admin;
    public $url_path='profile';

    public function __construct (Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //page lang
        $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>1]);
        //admin data
        $this->admin=$this->app->admin();
        //page role
        $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin->role]);

    }

    public function updateProfile($data)
    {
        if(DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update($this->app->getValidPostKey($data,['_token','ccode'])))
        {
            return 'basarili';
        }
    }

    public function changePassword($data=false)
    {
        if($data)
        {
            //db table update true
            if(DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update(['password'=>$this->app->passwordHash($data)]));
            {
                //userhash forget
                Session::forget('userHash');
                return true;
            }

            return false;
        }

    }


    public function uploadUpdate($file)
    {
        return DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update(['photo'=>$file]);
    }


}
