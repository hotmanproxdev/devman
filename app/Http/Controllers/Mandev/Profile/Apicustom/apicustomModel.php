<?php

namespace App\Http\Controllers\Mandev\Apicustom;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class apicustomModel extends Controller
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
        return DB::table($this->app->dbTable(['__table__']))
                  ->where(
                          function ($query)
                          {
                               if($this->request->ajax() && !array_key_exists("ajax",\Input::all()))
                               {
                                   foreach (app("\Filter")->getData($this->filterHas()) as $key=>$value)
                                   {
                                      $query->where(''.$this->app->dbTable(['__table__']).'.'.$key.'',"=",$value);
                                   }
                               }
                               else
                               {
                                   app("\Filter")->forget();
                               }
                          }
                          )
                          ->orderBy("id","desc")
                          ->paginate(10);
   }


     public function postApicustom()
     {
            return DB::table($this->app->dbTable(['__table__']))->where("id","=",\Input::get("id"))->update($this->app->getvalidPostkey(\Input::all(),['_token']));
     }


     public function postApicustomnew()
     {
            \Input::merge(array('created_at' =>time()));
            \Input::merge(array('updated_at' =>time()));

             return DB::table($this->app->dbTable(['__table__']))->insert($this->app->getvalidPostkey(\Input::all(),['_token']));
     }

      public function postprocessapicustom()
      {
          if(\Input::get("apicustomsignprocess")=="1")
          {
             $return=[];
             foreach (\Input::get("sign") as $sign)
             {
                if(DB::table($this->app->dbTable(['__table__']))->delete(['id'=>$sign])==false)
                {
                    return false;
                }
             }

             return true;

          }


      }

    private function filterHas()
    {
        return app("\Filter")->filterHas();
    }




}
