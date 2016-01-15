<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ModelApi extends Controller
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

    public function admin ()
    {
        return DB::table($this->app->dbTable(['admin']))->orderBy("id","desc")->get();
    }

    public function logs ()
    {
        return DB::table($this->app->dbTable(['logs']))->orderBy("id","desc")->get();
    }

    public function words ()
    {
        return DB::table($this->app->dbTable(['words']))->orderBy("id","desc")->get();
    }

    public function roles ()
    {
        return DB::table($this->app->dbTable(['roles']))->orderBy("id","desc")->get();
    }

    public function api ()
    {
        return DB::table($this->app->dbTable(['api']))->orderBy("id","desc")->get();
    }
}
