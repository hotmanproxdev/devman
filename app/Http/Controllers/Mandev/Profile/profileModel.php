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
        //admin data
        $this->admin=$this->app->admin();
        //page role
        $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);

    }

    public function updateProfile($data)
    {
        return DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update($this->app->getValidPostKey($data,['_token','ccode']));
    }

    public function changePassword($data=false,$id)
    {
        if($data)
        {
            //db table update true
            if(DB::table($this->app->dbTable(['admin']))->where("id","=",$id)->update(['password'=>$this->app->passwordHash($data)]));
            {
                if($this->admin->id==$id)
                {
                    //userhash forget
                    Session::forget('userHash');
                }

                return true;
            }

            return false;
        }

    }


    public function uploadUpdate($file)
    {
        return DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['photo'=>$file]);
    }


}
