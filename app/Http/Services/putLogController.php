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
        if($this->request->getPathInfo()=="/mandev/test/desktopnotification")
        {
            exit();
        }
        if(!preg_match('@^\/api.*@',$this->request->getPathInfo()))
        {
            $data['userid']=$this->admin->id;
            $data['ccode']=$this->app->ccode($this->admin->ccode);

            $data['userip']=ip2long($this->request->ip());
            $data['ip']=$this->request->ip();
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

            $data['user_agent']='';
            $data['user_host']=$this->request->header('host');
            $data['user_host']='';

            $data['url_path']=$this->request->fullUrl();
            $data['url_path_explain']=$this->request->getPathInfo();
            $data['log_process']=(array_key_exists("_token",$post)) ? 2 : 1;
            $data['msg']='access';
            $data['postdata']=(array_key_exists("_token",$post)) ? json_encode($post) : json_encode([]);
            $data['getdata']=(!array_key_exists("_token",$post)) ? json_encode($post) : json_encode([]);
            $data['created_at']=time();

           if(DB::table($this->app->dbTable(['logs']))->insert($data))
           {
               if(!$this->adminLogsUpdate())
               {
                   return false;
               }
           }

            return false;
        }


    }


    private function adminLogsUpdate()
    {
        $generalCounts=DB::table($this->app->dbTable(['log_statistics']))->select("general_counts")->where("id","=",1);

        $generalCountsGet=$generalCounts->get();

        $generalCountsArray=json_decode($generalCountsGet[0]->general_counts,1);

        $generalCountsArray['adminLogs']=$generalCountsArray['adminLogs']+1;

        return $generalCounts->update(['general_counts'=>json_encode($generalCountsArray)]);


    }



}
