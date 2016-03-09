<?php

namespace App\Http\Controllers\Mandev\Logs;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class logsModel extends Controller
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

    public function getLogs()
    {
        //develop mode user
        if($this->admin->system_number==0)
        {
            return DB::table($this->app->dbTable(['logs']))->orderBy("id","desc")->paginate(config("app.paginator"));
        }

        //normal user
        return DB::table($this->app->dbTable(['logs']))->where("ccode","=",$this->app->ccode($this->admin->ccode))->orderBy("id","desc")->paginate(config("app.paginator"));

    }




}
