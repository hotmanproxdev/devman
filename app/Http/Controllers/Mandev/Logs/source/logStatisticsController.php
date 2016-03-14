<?php

namespace App\Http\Controllers\Mandev\Logs\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Logs\logsModel;
use DB;

class logStatisticsController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='logs';
    public $model;
    public $logCounter;
    public $logCounterArray;

    public function __construct (Request $request,logsModel $model)
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
        //admin view
        $this->data['admin']=$this->admin;
        //get model
        $this->model=$model;
        //get log counter
        $this->logCounter=$this->model->getLogCounter();
        //array log counter
        $this->logCounterArray=json_decode($this->logCounter,1);


    }

    public function getLogColumnChart()
    {
        //for system develop
        if($this->admin->system_number==0)
        {
            //ccode counter
            return app("\Chart")->columnChart(['chart_number'=>[1],'data'=>[$this->logCounterArray['ccode']],'text'=>$this->data['systemcodecolumntext']]);
        }

        //get ccode username query
        foreach ($this->logCounterArray[$this->admin->ccode] as $username=>$count)
        {
            $logCounterUsername[$this->app->getUsers($username)[0]->username]=$count;
        }

        //ccode username counter
        return app("\Chart")->columnChart(['chart_number'=>[1],'data'=>[$logCounterUsername],'text'=>$this->data['systemcodecolumntextusername']]);


    }


    public function getLogPieChart()
    {

        //for system develop
        if($this->admin->system_number==0)
        {
            //ccode counter
            return app("\Chart")->pieChart(['chart_number'=>[1,2],'data'=>[$this->logCounterArray['osFamily'],$this->logCounterArray['osFamily']],'text'=>$this->data['systemcodepieosfamilytext'],'type'=>'']);
        }

    }




}
