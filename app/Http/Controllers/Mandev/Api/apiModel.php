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
            return DB::table($this->app->dbTable(['api']))
                            ->where("system_ccode","=",$this->admin->ccode)
                            ->where(function($query)
                            {
                                foreach (app("\Filter")->getData() as $key=>$value)
                                {
                                    $query->where($key,"=",$value);
                                }
                            })
                            ->orderBy("id","desc")->paginate(config("app.paginator"));
        });
    }

    public function getSystemCodes()
    {
        //system developer query callback
        return app("\DevSource")->control(['api','group'=>'system_ccode'],function()
        {
            //if callback false, call query according to admin's system_code group by
            return DB::table($this->app->dbTable(['api']))->select(['system_ccode'])
                                                          ->where("system_ccode","=",$this->admin->ccode)
                                                          ->groupBy("system_ccode")
                                                          ->orderBy("id","desc")
                                                          ->paginate(config("app.paginator"));
        });
    }


    public function getUserApi()
    {
        //get query users api
        $query=DB::table($this->app->dbTable(['api']))->where("id","=",\Input::get("id"))->get();

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


    public function updateUserApi()
    {
        return app("\Transaction")->commit(function()
        {
            //post id control for manipulation
            if(!is_array($this->getUserApi(\Input::get("id"))))
            {
                return false;
            }

            //reel key post data
            $postdata=$this->app->getvalidPostKey(\Input::all(),['_token','id']);

            //access services implode string key converter
            if(array_key_exists("access_services",\Input::all()))
            {
                $postdata['access_services']=implode("-",$postdata['access_services']);
            }
            else
            {
                $postdata['access_services']=NULL;
            }

            //forbidden access services implode string key converter
            if(array_key_exists("forbidden_access_services",\Input::all()))
            {
                $postdata['forbidden_access_services']=implode("-",$postdata['forbidden_access_services']);
            }
            else
            {
                $postdata['forbidden_access_services']=NULL;
            }

            //query booelean true
            return DB::table($this->app->dbTable(['api']))->where("id","=",\Input::get("id"))->update($postdata);
        });
    }



}
