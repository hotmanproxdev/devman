<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class devSourceController extends Controller
{

    public $app;

    public function __construct()
    {
        //page protector
        $this->middleware('auth');
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
    }

    public function control($data=array(),$callback)
    {
        if($this->admin->system_number==0)
        {
            return \DB::table($this->app->dbTable([$data[0]]))->orderBy("id","asc")->paginate(config("app.paginator"));
        }
        else
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }



    }
}
