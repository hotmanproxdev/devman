<?php

namespace App\Http\Controllers\Mandev\Users;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class usersModel extends Controller
{
    public $request;
    public $app;
    public $admin;

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

    public function getUsers()
    {
        if($this->admin->system_number==0)
        {
            //for just system developers
            return DB::table($this->app->dbTable(['admin']))->orderBy("updated_at","desc")->paginate(config("app.paginator"));
        }

        //for system developers and managers
        return DB::table($this->app->dbTable(['admin']))->where("ccode","=",$this->admin->ccode)->orderBy("updated_at","desc")->paginate(config("app.paginator"));

    }


    public function newUserCreate($data=array())
    {
        if(count($data))
        {
            return DB::table($this->app->dbTable(['admin']))->insert($data);
        }
    }





}
