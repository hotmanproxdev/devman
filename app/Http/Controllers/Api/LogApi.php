<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use BrowserDetect;
use GeoIP;

class LogApi extends Controller
{

    public $request;
    public $app;

    public function __construct(Request $request)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
    }


    public function set($param=array())
    {
        if(array_key_exists("version",\Input::all()))
        {
            if(preg_match('@v(\d+)@is',\Input::get("version")))
            {
                $version=str_replace("v","",\Input::get("version"));
                $data['version']=$version;
            }

        }

        $sentdata=[
                    'select'=>json_decode($this->request->header("select")),
                    'where'=>json_decode($this->request->header("where"))

                  ];

        $data['sentdata']=json_encode($sentdata);

        $data['userip']=ip2long($this->request->ip());
        $data['ip']=$this->request->ip();

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

        $data['user_host']=$this->request->header('host');

        $data['url_path']=$this->request->fullUrl();
        $data['url_path_explain']=$this->request->getPathInfo();
        $data['serviceName']=explode("/",$this->request->getPathInfo())[3];

        if(array_key_exists($data['serviceName'],$this->app->dbTable(['all'])))
        {
           $data['custom']=0;
        }
        else
        {
            $data['custom']=1;
        }
        $data['msg']=$param['msg'];

        if($this->request->header("postdata"))
        {
            $data['postdata']=$this->request->header("postdata");
        }
        else
        {
            $data['postdata']='';
        }

        $data['getdata']=json_encode(\Input::all());
        $data['headerData']=$this->request->headers;

        if(array_key_exists("forbidden_access_services",$param))
        {
            //forbidden access services
            if(count($param['forbidden_access_services']))
            {
                if(in_array($data['serviceName'],$param['forbidden_access_services']))
                {
                    $data['forbidden_access']=1;
                    $data['manipulation']=1;
                }
            }
        }


        if(array_key_exists("manipulation",$param))
        {
            $data['manipulation']=1;
        }

        if(array_key_exists("condHash",$param))
        {
            if($param['condHash'])
            {
                $data['apikey']=$param['key'];
                $data['hash']=\Input::get("hash");
            }
        }

        if(array_key_exists("ccode",$param))
        {
            if($param['ccode']=="guest")
            {
                $data['apikey']=$param['key'];
                $data['hash']=\Input::get("hash");

            }
        }

        if(array_key_exists("staticIp",$param))
        {
            $data['staticIp']=$param['staticIp'];
            $data['apikey']=$param['key'];
            $data['hash']=\Input::get("hash");
        }


        if(array_key_exists("access",$param))
        {
            $data['access']=$param['access'];
        }


        if(array_key_exists("keyOrHashValid",$param))
        {
            if(array_key_exists("condHash",$param))
            {
                if(!$param['condHash'])
                {
                    $data['keyOrHashValid']=0;
                }
                else
                {
                    $data['keyOrHashValid']=$param['keyOrHashValid'];
                }

            }
        }



        if(array_key_exists("access_point",$param))
        {
            $data['access_point']=$param['access_point'];
        }

        if(array_key_exists("sess_apikey",$param))
        {
            $data['apikey']=$param['sess_apikey'];
            $data['hash']=$param['sess_apihash'];
        }

        if(array_key_exists("service_closed",$param))
        {
            $data['service_closed']=$param['service_closed'];
        }

        if(array_key_exists("ccode",$param))
        {
            if($param['ccode']=="develop")
            {
                $data['ccode']=1;
            }
            else
            {
                $data['ccode']=2;
            }

        }

        if(array_key_exists("system_ccode",$param))
        {
            $data['system_ccode']=$this->app->ccode($param['system_ccode']);
        }

        $data['created_at']=time();


        DB::table($this->app->dbTable(['log_api']))->insert($data);
    }

}