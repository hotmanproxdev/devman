<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class apiServicesController extends Controller
{

    public $request;
    public $app;
    public $data;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request method
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function get()
    {
        dd($this->app->dbTable(['all']));
    }
}
