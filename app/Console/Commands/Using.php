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
            $dd['select']=' <select class="form-control select2me" data-placeholder="Select..."><option value=""></option><option value="AL">Alabama</option><option value="WY">Wyoming</option>
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
    }
}
