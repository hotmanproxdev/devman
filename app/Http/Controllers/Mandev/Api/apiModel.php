<?php

namespace App\Http\Controllers\Mandev\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class apiModel extends Controller
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

    public function getApiAccesses()
    {
        //system developer query callback
        return app("\DevSource")->control(['api'],function()
        {
            //if callback false, call query according to admin's system_code
            return DB::table($this->app->dbTable(['api']))->where("system_code","=",$this->admin->ccode)->orderBy("id","desc")->paginate(config("app.paginator"));
        });
    }


    public function getUserApi($id)
    {
        //get query users api
        $query=DB::table($this->app->dbTable(['api']))->where("id","=",$id)->get();

        //query count is true
        return app("\Query")->isCountTrue($query,function() use ($query)
        {
            //user just can edit own group (except system_code 0)
            return app("\DevSource")->ccode($query[0]->system_ccode,function() use ($query)
            {
               //true
               return $query;
            });
        });


    }




}
