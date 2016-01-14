<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use BrowserDetect;
use GeoIP;

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
    public function admin($log=array(),$post=array())
    {

        $data['userid']=$this->admin->id;
        $data['userip']=$this->request->ip();
        $data['userHash']=$this->admin->hash;

        foreach (GeoIP::getLocation() as $key=>$value)
        {
            if(($key!=="ip") AND ($key!=="default"))
            {
                $data[$key]=$value;
            }
        }

        foreach (BrowserDetect::toArray() as $key=>$value)
        {
            $data[$key]=$value;
        }

        $data['referer']=$this->request->header("referer");
        $data['formprocess']=($this->request->ajax()) ? 'Ajax Request' : 'Normal Request';
        $data['user_agent']=$this->request->header('User-Agent');
        $data['user_host']=$this->request->header('HOST');
        $data['url_path']=$this->request->fullUrl();
        $data['url_path_explain']=$this->request->getPathInfo();
        $data['log_process']=(count($post)) ? 2 : 1;
        $data['msg']='access';
        $data['postdata']=json_encode($post);
        $data['created_at']=time();

        return DB::table("prosystem_administrator_process_logs")->insert($data);

    }


}
