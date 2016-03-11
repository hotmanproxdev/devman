<?php

namespace App\Http\Controllers\Mandev\Logs;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Logs\logsModel;
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

        public function __construct (Request $request,logsModel $model,Validation $validation,Notification $notification)
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

        }

    public function getIndex ()
    {
        //get log data
        $this->data['logs']=$this->model->getLogs();

        //logging statistics data
        $this->data['columnChart']=$this->getLogColumnChart();

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }

    public function getLogColumnChart()
    {
        //get log counter
        $logCounter=$this->model->getLogCounter();

        //array log counter
        $logCounterArray=json_decode($logCounter,1);

        //for system develop
        if($this->admin->system_number==0)
        {
            //ccode counter
            return app("\Chart")->columnChart(['chart_number'=>[1],'data'=>[$logCounterArray['ccode']],'text'=>$this->data['systemcodecolumntext']]);
        }

        //get ccode username query
        foreach ($logCounterArray[$this->admin->ccode] as $username=>$count)
        {
            $logCounterUsername[$this->app->getUsers($username)[0]->username]=$count;
        }

        //ccode username counter
        return app("\Chart")->columnChart(['chart_number'=>[1],'data'=>[$logCounterUsername],'text'=>$this->data['systemcodecolumntextusername']]);


    }
}
