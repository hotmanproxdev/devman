<?php

namespace App\Http\Controllers\Mandev\Test;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;


class testController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='test';

        public function __construct (Request $request)
        {
             //page protector
             $this->middleware('auth');
             //request class
             $this->request=$request;
             //base service provider
             $this->app=app()->make("Base");
             //page lang
             $this->data=$this->app->getLang(['url_path'=>"default",'lang'=>1]);
             //menu statu
             $this->data['menu']=$this->app->menuStatu('normal');
             //admin data
             $this->admin=$this->app->admin();

        }

    public function getAutocomplete ()
    {
        //return view
        return app("\Autocomplete")->get();
    }

}
