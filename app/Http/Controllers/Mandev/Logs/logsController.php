<?php

namespace App\Http\Controllers\Mandev\Logs;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Logs\logsModel;
use App\Http\Controllers\Mandev\Logs\Source\sourceController as Source;
use DB;
use Validation;
use Notification;
use Input;

class logsController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='logs';
        public $model;
        public $validation;
        public $notification;

        public function __construct (Request $request,logsModel $model,Validation $validation,Notification $notification,Source $source)
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
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>18,'admin'=>$this->admin]);
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
        //get log data
        $this->data['logs']=$this->model->getLogs();

        //logging statistics data
        $this->data['columnChart']=$this->source->data("logStatistics")->get("getLogColumnChart");

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }

}
