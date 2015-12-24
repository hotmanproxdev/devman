<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;

class putLogController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $post;
    public $admin;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
    }
    public function put($log=array(),$post=array())
    {
        $data['userid']=$this->admin->id;
        $data['userip']=$this->request->ip();
        $data['formprocess']=($this->request->ajax()) ? 'Ajax Request' : 'Normal Request';
        $data['user_agent']=$this->request->header('User-Agent');
        $data['user_host']=$this->request->header('HOST');
        $data['url_path']=$this->request->fullUrl();
        $data['url_path_explain']=$this->request->getPathInfo();
        $data['log_process']=(count($post)) ? 2 : 1;
        $data['postdata']=json_encode($post);
        $data['created_at']=time();

        return DB::table("prosystem_administrator_process_logs")->insert($data);

    }
}
