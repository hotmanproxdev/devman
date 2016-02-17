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
            if(array_key_exists("group",$data))
            {
                return \DB::table($this->app->dbTable([$data[0]]))->select([$data['group']])->groupBy($data['group'])->orderBy("id","asc")->paginate(config("app.paginator"));
            }

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


    public function ccode($ccode,$callback)
    {
        $val=false;

        if($this->admin->system_number==0)
        {
            $val=true;
        }
        else
        {
            if($this->admin->ccode==$ccode)
            {
                $val=true;
            }
        }

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        //redirect to logout
        $this->notification->manipulation(['msg'=>$this->data['manipulation'],'title'=>$this->data['error']]);

        //redirect to logout
        dd($this->data['manipulation']);


    }
}
