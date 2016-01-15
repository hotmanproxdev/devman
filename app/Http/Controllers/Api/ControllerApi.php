<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ControllerApi extends Controller
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

    public function services()
    {
        return ['test','admin','logs','words','roles'];
    }

    public function developer ($apiHash=false)
    {
        if($apiHash)
        {
            $developer=DB::table($this->app->dbTable(['api']))->where("ccode","=",config("app.api_ccode"))->where("hash","=",$apiHash)->get();
            if(count($developer))
            {
                return true;
            }

            return false;

        }
    }
}
