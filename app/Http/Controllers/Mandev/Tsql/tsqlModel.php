<?php

namespace App\Http\Controllers\Mandev\Tsql;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class tsqlModel extends Controller
{
    public $request;
    public $app;
    public $admin;
    public $logst;
    public $admint;

    public function __construct (Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page role
        $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);

    }

    public function getLogs()
    {
        $this->logst=$this->app->dbTable(['logs']);
        $this->admint=$this->app->dbTable(['admin']);


        //default query
        return DB::table($this->app->dbTable(['logs']))->
                                                        select(''.$this->logst.'.*',''.$this->admint.'.username')
                                                        ->join($this->admint,''.$this->logst.'.userid','=',''.$this->admint.'.id')
                                                        ->where(
                                                                        function ($query)
                                                                        {
                                                                            if($this->request->ajax())
                                                                            {
                                                                                foreach (app("\Filter")->getData() as $key=>$value)
                                                                                {
                                                                                    if($key=="username")
                                                                                    {
                                                                                        $query->where(''.$this->admint.'.'.$key.'','like','%'.$value.'%');
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                        $query->where(''.$this->logst.'.'.$key.'',"=",$value);
                                                                                    }


                                                                                }
                                                                            }

                                                                        }
                                                                        )
                                                                        ->orderBy("id","desc")
                                                                        ->paginate(10);
    }




}
