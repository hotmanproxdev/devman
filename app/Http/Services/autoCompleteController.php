<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;

class autoCompleteController extends Controller
{

    public function __construct()
    {
        //page protector
        $this->middleware('auth');
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function get()
    {
        //get model explode with /
        $model=explode("/",Input::get("automodel"));

        return $this->$model[0]();

    }

    public function admin()
    {
        //get model explode with /
        $model=explode("/",Input::get("automodel"));

        //get value
        $value=str_replace("____"," ",Input::get("autoval"));


        if($this->admin->system_number==0)
        {
            $this->data['query']=\DB::table($this->app->dbTable(['admin']))->select(['id','fullname','photo','system_name'])->where($model[1],'like','%'.$value.'%')->take(10)->get();

        }
        else
        {
            $this->data['query']=\DB::table($this->app->dbTable([$model[0]]))->select(['id','fullname','photo','system_name'])->where("ccode","=",$this->admin->ccode)->where($model[1],'like','%'.$value.'%')->take(10)->get();
        }

        if(count($this->data['query']))
        {
            //return view
            return view("".config("app.admin_dirname").".autocomplete.admin_".Input::get("context")."",$this->data);
        }

    }
}
