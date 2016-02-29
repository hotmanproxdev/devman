<?php

namespace App\Http\Controllers\Api\Custom;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ApimaxApi extends Controller
{

    public $request;
    public $app;

    public function __construct (Request $request)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function get ()
    {
       //your query
       $query=DB::table($this->table("api"))
                        ->select($this->select())
                        ->where(function ($query)
                        {
                           foreach ($this->where() as $key=>$value)
                           {
                               if(is_array($value))
                               {
                                  $query->whereIn($key,$value);
                               }
                               else
                               {
                                  $query->where($key,"=",$value);
                               }

                           }
                        })
                        ->get();

       //output send
       return $this->output($query);
    }

    private function table ($table)
    {
       return $this->app->dbTable([$table]);
    }

    private function select()
    {
       if($this->request->header("select"))
       {
           return json_decode($this->request->header("select"),true);
       }

       return '*';
    }

    private function where()
    {
       if($this->request->header("where"))
       {
          return json_decode($this->request->header("where"),true);
       }

       return [];
    }


     private function update()
     {
        if($this->request->header("update"))
        {
            return json_decode($this->request->header("update"),true);
        }

        return [];
     }

    private function postdata()
    {
       return $this->app->getvalidPostKey(json_decode($this->request->header("postdata"),1),['_token']);
    }


    private function output($query)
        {
            if(count($query))
            {
                $result=['success'=>true,'query'=>$query];
            }
            else
            {
                $result=['success'=>false,'query'=>$query];
            }

            return json_encode($result);
        }

}
