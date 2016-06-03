<?php

namespace App\Http\Controllers\Mandev\Adminlog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class adminlogModel extends Controller
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
        return DB::table($this->app->dbTable(['logs']))
                 ->select(''.$this->app->dbTable(['logs']).'.*',''.$this->app->dbTable(['admin']).'.username')
                 ->join (''.$this->app->dbTable(['admin']).'',''.$this->app->dbTable(['logs']).'.userid','=',''.$this->app->dbTable(['admin']).'.id')
                  ->where(
                          function ($query)
                          {
                              if($this->admin->system_number>0)
                              {
                                  $query->where("".$this->app->dbTable(['logs']).".ccode","=",$this->app->ccode($this->admin->ccode));
                              }
                               if($this->request->ajax() && !array_key_exists("ajax",\Input::all()))
                               {
                                   foreach (app("\Filter")->getData($this->filterHas()) as $key=>$value)
                                   {
                                       if($key=="username")
                                       {
                                           if(is_numeric($value))
                                           {
                                               $query->where(''.$this->app->dbTable(['admin']).'.id',"=",$value);
                                           }
                                           else
                                           {
                                               $query->where(''.$this->app->dbTable(['admin']).'.'.$key.'',"like",'%'.$value.'%');
                                           }

                                       }
                                       else
                                       {
                                           $query->where(''.$this->app->dbTable(['logs']).'.'.$key.'',"=",$value);
                                       }

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


    public function getBrowserFamily()
    {
         $browserFamily=DB::table($this->app->dbTable(['logs']))->select("browserFamily")->groupBy("browserFamily")->get();
        $browserFamilyList=[];
         foreach ($browserFamily as $result)
         {
             $browserFamilyList[$result->browserFamily]=$result->browserFamily;
         }

         return $browserFamilyList;
    }



    public function getOsFamily()
    {
        $osFamily=DB::table($this->app->dbTable(['logs']))->select("osFamily")->groupBy("osFamily")->get();
        $osFamilyList=[];
        foreach ($osFamily as $result)
        {
            $osFamilyList[$result->osFamily]=$result->osFamily;
        }

        return $osFamilyList;
    }


    public function getdeviceFamily()
    {
        $deviceFamily=DB::table($this->app->dbTable(['logs']))->select("deviceFamily")->groupBy("deviceFamily")->get();
        $deviceFamilyList=[];
        foreach ($deviceFamily as $result)
        {
            if(strlen($result->deviceFamily)>0)
            {
                $deviceFamilyList[$result->deviceFamily]=$result->deviceFamily;
            }

        }

        return $deviceFamilyList;
    }





    private function filterHas()
    {
        return app("\Filter")->filterHas();
    }




}
