<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ControllerApi extends Controller
{

    public $request;
    public $app;
    protected $headers=['device','mode','company'];
    protected $device=['ios','android','web'];
    protected $mode=['select'];
    protected $company=['teknasyon'];

    public function __construct (Request $request)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");

    }

    public function services()
    {
        //default service
        $services[]='test';

        //db table services
        foreach ($this->app->dbTable(['all']) as $tabkey=>$tabindex)
        {
            $services[]=$tabkey;
        }

        $apicustom=DB::table($this->app->dbTable(['api_custom']))->get();

        if(count($apicustom))
        {
            foreach ($apicustom as $custom)
            {
                $services[]=$custom->custom_models;
            }
        }


        //return
        return $services;
    }

    public function developer ($apiHash=false)
    {
        if($apiHash)
        {
            $developer=DB::table($this->app->dbTable(['api']))->where("ccode","=",config("app.api_ccode"))->where("statu","=",1)->where("hash","=",$apiHash)->get();

            if(count($developer))
            {
                if($developer[0]->access_services!==NULL)
                {
                    $access_services=explode("-",$developer[0]->access_services);
                }
                else
                {
                    $access_services=array();
                }

                if($developer[0]->access_service_key)
                {
                    return ['success'=>true,'apiId'=>$developer[0]->id,'access_services'=>$access_services,'user'=>$developer];
                }

                return ['success'=>false,'msg'=>'access service key closed'];

            }

            return ['success'=>false,'msg'=>'your api access has been terminated'];
        }

        return ['success'=>false,'msg'=>'you dont have valid hash'];
    }


    public function coding ($active=false)
    {
            if(!$active) $active='';

            $coding_developer=DB::table($this->app->dbTable(['api']))->where("standart_key","=",$active)->get();

            if($coding_developer[0]->access_services!==NULL)
            {
                $access_services=explode("-",$coding_developer[0]->access_services);
            }
            else
            {
                $access_services=array();
            }

            if(count($coding_developer)==false)
            {
                return ['success'=>false,'msg'=>'invalid standart key'];
            }
            else
            {
                if($coding_developer[0]->access_service_key==false)
                {
                    return ['success'=>false,'msg'=>'access service key closed'];
                }
            }

            $list=[];
            foreach ($this->headers as $headers)
            {
                if(in_array($this->request->header($headers),$this->$headers))
                {
                    $list[]=1;
                }
                else
                {
                    $list[]=0;
                }
            }

            if(in_array(false,$list))
            {
                return ['success'=>false,'msg'=>'you have invalid headers'];
            }

            return ['success'=>true,'apiId'=>$coding_developer[0]->id,'access_services'=>$access_services,'user'=>$coding_developer];

    }
}
