<?php

namespace App\Http\Controllers\Mandev\Tsql;

use App\Http\Services\queryController;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Tsql\tsqlModel;
use App\Http\Controllers\Mandev\Tsql\source\sourceController as Source;
use DB;
use Validation;
use Notification;
use Input;

class tsqlController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='tsql';
        public $model;
        public $validation;
        public $notification;
        public $source;

        public function __construct (Request $request,tsqlModel $model,Validation $validation,Notification $notification,Source $source)
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

        }

        public function getIndex ()
        {
            //get tsql list
            $this->data['query'] = $this->source->data("tsql")->get("getPackList");

            //get tsql list
            $this->data['query2'] = $this->source->data("tsql")->get("getPackList2");

            //ajax return view
            $view=view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);

            if($this->request->ajax())
            {
                $sections = $view->renderSections();
                return $sections['content'];
            }

            return $view;

        }


        public function postTsqlfilter()
        {
            return app("\Filter")->data(function()
            {
                return $this->getIndex();
            });

        }



}
