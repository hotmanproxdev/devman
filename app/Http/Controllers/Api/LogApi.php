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
        $data['msg']=$param['msg'];
        $data['postdata']='';
        $data['getdata']=json_encode(\Input::all());
        $data['headerData']=$this->request->headers;

        if(array_key_exists("manipulation",$param))
        {
            $data['manipulation']=1;
        }

        if(array_key_exists("condHash",$param))
        {
            if($param['condHash'])
            {
                $data['key']=$param['key'];
                $data['hash']=\Input::get("hash");
            }
        }

        if($param['ccode']=="guest")
        {
            $data['key']=$param['key'];
            $data['hash']=\Input::get("hash");
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

        if(array_key_exists("service_closed",$param))
        {
            $data['service_closed']=$param['service_closed'];
        }

        if(array_key_exists("ccode",$param))
        {
            $data['ccode']=$param['ccode'];
        }

        $data['created_at']=time();

        DB::table($this->app->dbTable(['log_api']))->insert($data);
    }

}