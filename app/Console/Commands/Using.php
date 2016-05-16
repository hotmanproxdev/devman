<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Using extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'using {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Using';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //formatter class helper
        if($this->argument("name")=="formatter")
        {
            $dd['formatter']='Formatter::make(data,Formatter::[ARR][JSON][CSV][XML][YAML])->to[ARR][JSON][CSV][XML][YAML]()';

            dd($dd);
        }

        //curl class helper
        if($this->argument("name")=="curl")
        {
            $dd['curl']='Curl::to("http://")->widthData(array())->asJson()->get--post()';

            dd($dd);
        }


        //notification using
        if($this->argument("name")=="notification")
        {
            $dd['notification']="notification::send(['msg'=>'msg','title'=>'title','position'=>'top-right', 'function'=>'warning'])";

            dd($dd);
        }


        //db exporter seed
        if($this->argument("name")=="seed")
        {
            $dd['seed']="\Iseed::generateSeed('prosystem_roles')";

            dd($dd);
        }

        //timedef class helper
        if($this->argument("name")=="time")
        {
            $dd['getPassing']='Time::getPassing(inttime)->[data][unit][define][output]';

            dd($dd);
        }

        //putlog class helper
        if($this->argument("name")=="log")
        {
            $dd['time']="log::put(['info','info_explain','process'],postarray=false)";

            dd($dd);
        }


        //modal toggle helper
        if($this->argument("name")=="modal")
        {
            $dd['responsive']='<a class="btn default xmodal" model="test/modal" modal-title="test modal page" data-toggle="modal" href="#responsive">View Demo </a>';
            $dd['stack1']='<a class="btn default xmodal" model="test/modal" modal-title="test modal page" data-target="#stack1" href="#stack1" data-toggle="modal">View Demo </a>';
            $dd['full-width']='<a class="btn default xmodal" model="test/modal" modal-title="test modal page" data-target="#full-width" href="#full-width" data-toggle="modal">View Demo </a>';

            dd($dd);
        }


        //select using
        if($this->argument("name")=="select")
        {
            $dd['select']=' <select class="form-control select2" data-placeholder="Select..."><option value=""></option><option value="AL">Alabama</option><option value="WY">Wyoming</option>
                            </select>';

            dd($dd);
        }


        //tooltip using
        if($this->argument("name")=="tooltip")
        {
            $dd['tooltip']='class="tooltips" data-placement="top" data-original-title="Change dashboard date range"';

            dd($dd);
        }


        //fileupload
        if($this->argument("name")=="fileupload")
        {
            $dd['fileupload']="file::upload(['input'=>Input::all(),'name'=>'file','path'=>'upload/test']);";
            dd($dd);
        }


        //api
        if($this->argument("name")=="api")
        {
            $dd['api']="this->api->get(['service'=>'test'])";
            $dd['select']="this->api->get(['service'=>'test','select'=>['id'])";
            $dd['update']="this->api->get(['service'=>'test','update'=>['select'=>['username'=>'newusername'],'where'=>['id=?',[1])";
            dd($dd);
        }


        //api
        if($this->argument("name")=="token")
        {
            $dd['token']="return app('Token')->valid(function() { //somethings });";
            dd($dd);
        }

        //api
        if($this->argument("name")=="transaction")
        {
            $dd['transaction']="return app('transaction')->commit(function() { //somethings });";
            dd($dd);
        }

        //autocomplete
        if($this->argument("name")=="autocomplete")
        {
            $dd['autocomplete']='<input class="form-control autocomplete" model="admin/fullname" context="input" autocomplete="off">
            <div class="autocomplete_result"></div>';
            dd($dd);
        }

        //input on off
        if($this->argument("name")=="onoff")
        {
            $dd['onoff']='<input type="checkbox" checked class="make-switch" data-size="small">';
            dd($dd);
        }


        //linechart
        if($this->argument("name")=="chart")
        {
            $dd['linechart']="this->data['linechart']=app(\Chart)->lineChart(['chart_number'=>[2,3],'data'=>[linedata,linedata3]]);";
            $dd['columnchart']="this->data['columnchart']=app(\Chart)->columnChart(['chart_number'=>[2,3],'data'=>[linedata,linedata3],'text'=>'text']);";
            $dd['piechart']="this->data['piechart']=app(\Chart)->pieChart(['chart_number'=>[2,3],'data'=>[linedata,linedata3],'text'=>'text','type'=>'%']);";
            $dd['chartdiv']='<div id="charts"><div id="chart_column1" style="height: 600px; width: 100%;"></div><div id="chart_pie1" style="height: 600px; width: 100%;"></div></div>';
            dd($dd);
        }

        //filter
        if($this->argument("name")=="filter")
        {
            $dd['select']="{!! app(\Filter)->get(['none'=>'apiGroup','develop'=>'Developer','guest'=>'Guest','name'=>'ccode','type'=>'select']) !!}";
            $dd['input']="{!! app(\Filter)->get(['name'=>'apikey','placeholder'=>'Apikey Belirtin...','type'=>'input','class'=>'indent form-control']) !!}";
            dd($dd);
        }

        //changesql
        if($this->argument("name")=="changesql")
        {
            $dd['changesql']='changesql="api//system_ccode//ccode//api//ccode" changesqlresult="ccode"';
            dd($dd);
        }

        //make switch
        if($this->argument("name")=="make-switch")
        {
            $dd['make-switch']="name='field' data-model='table/field/where'";
            dd($dd);
        }


        //pdf
        if($this->argument("name")=="pdf")
        {
            $dd['stream']='app("\Output")->pdfStream($data,$file)';
            $dd['download']='app("\Output")->PdfDownload("data","file")';
            $dd['save']='app("\Output")->pdfSave($data,$file)';
            dd($dd);
        }




    }
}
