<?php

namespace App\Http\Controllers\Api\Custom;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class MymeApi extends Controller
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

    public function get ()
    {
        //make somethings
    }

    public function table ($table)
    {
        return $this->app->dbTable([$table]);
    }

}
