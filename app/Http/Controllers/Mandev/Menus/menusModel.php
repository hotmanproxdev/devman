<?php

namespace App\Http\Controllers\Mandev\Menus;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class menusModel extends Controller
{
    public $request;
    public $app;
    public $admin;
    public $api;

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
        //get api services
        $this->api=app("Api")->version(config("app.apiversion"));

    }

    public function get()
    {
        //default filter query
        return DB::table($this->app->dbTable(['menu']))
                  ->where(
                          function ($query)
                          {
                               if($this->request->ajax() && !array_key_exists("ajax",\Input::all()))
                               {
                                   foreach (app("\Filter")->getData($this->filterHas()) as $key=>$value)
                                   {
                                       if($key=="menu" or $key=="link")
                                       {
                                           $query->where(''.$this->app->dbTable(['menu']).'.'.$key.'',"like",'%'.$value.'%');
                                       }
                                       else
                                       {
                                           $query->where(''.$this->app->dbTable(['menu']).'.'.$key.'',"=",$value);
                                       }

                                   }
                               }
                               else
                               {
                                   app("\Filter")->forget();
                               }
                          }
                          )
                          ->orderBy("row","asc")
                          ->paginate(10);
    }


    public function postMenus()
    {
        return app("\Query")->uplog(['menu'],function()
        {
            return \App\Models\Menu::where("id","=",\Input::get("id"))->update($this->app->getvalidPostkey(\Input::all(),['_token']));
        });

    }


    public function postMenusnew()
    {
        \Input::merge(array('created_at' =>time()));
        \Input::merge(array('updated_at' =>time()));

        return \App\Models\Menu::firstOrCreate($this->app->getvalidPostkey(\Input::all(),['_token']));
    }

    public function postprocessmenus()
    {
        if(\Input::get("menussignprocess")=="1")
        {
            $return=[];
            foreach (\Input::get("sign") as $sign)
            {
                if(\App\Models\Menu::find($sign)->delete()==false)
                {
                    return false;
                }
            }

            return true;

        }


    }


    public function getMainMenus()
    {
        $menus=\App\Models\Menu::where("parent","=","0")->where("status","=",1)->get();

        $list=[];

        foreach ($menus as $result)
        {
            $list[$result->id]=$result->menu;
        }

        return $list;
    }

    private function filterHas()
    {
        return app("\Filter")->filterHas();
    }




}
