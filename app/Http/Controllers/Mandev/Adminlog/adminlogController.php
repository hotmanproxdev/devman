<?php

namespace App\Http\Controllers\Mandev\Adminlog;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Adminlog\adminlogModel;
use App\Http\Controllers\Mandev\Adminlog\source\sourceController as Source;
use DB;
use Validation;
use Notification;
use Input;

class adminlogController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='adminlog';
        public $model;
        public $validation;
        public $notification;
        public $source;
        public $api;

        public function __construct (Request $request,adminlogModel $model,Validation $validation,Notification $notification,Source $source)
        {
             //page protector
             $this->middleware('auth');
             //request class
             $this->request=$request;
             //base service provider
             $this->app=app()->make("Base");
             //admin data
             $this->admin=$this->app->admin();
             //page lang
             $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>$this->admin->lang]);
             //menu statu
             $this->data['menu']=$this->app->menuStatu('normal');
             //page role
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);
             //admin view
             $this->data['admin']=$this->admin;
             //get model
             $this->model=$model;
             //get validation
             $this->validation=$validation;
             //get notifications
             $this->notification=$notification;
             //get source
             $this->source=$source;
             //get api services
             $this->api=app("Api")->version(config("app.apiversion"));

        }

    public function getIndex ()
    {
        //get adminlog list
        $this->data['query'] = $this->source->data("adminlog")->get("get");

        //ajax return view
        $view=view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);

        if($this->request->ajax())
        {
            $sections = $view->renderSections();
            return $sections['tsql'];
        }

        return $view;

    }


    public function postAdminlogfilter()
    {
        return app("\Filter")->data(function()
        {
            return $this->getIndex();
        });
    }

}
