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
        //return services from app
        return $this->app->services(true);
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

                if($developer[0]->forbidden_access_services!==NULL)
                {
                    $forbidden_access_services=explode("-",$developer[0]->forbidden_access_services);
                }
                else
                {
                    $forbidden_access_services=array();
                }


                if($developer[0]->access_service_key)
                {
                    return ['success'=>true,'apiId'=>$developer[0]->id,'access_services'=>$access_services,'forbidden_access_services'=>$forbidden_access_services,'user'=>$developer];
                }

                return ['success'=>false,'msg'=>'access service key closed'];

            }

            return ['success'=>false,'msg'=>'please,have any session info or guest mode for that your api access'];
        }

        return ['success'=>false,'msg'=>'you dont have valid hash'];
    }


    public function guest ()
    {
            if(array_key_exists("key",\Input::all()) and array_key_exists("hash",\Input::all()))
            {
                $developer=DB::table($this->app->dbTable(['api']))->where("ip","=",$this->request->ip())->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"))->get();

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

                    if($developer[0]->forbidden_access_services!==NULL)
                    {
                        $forbidden_access_services=explode("-",$developer[0]->forbidden_access_services);
                    }
                    else
                    {
                        $forbidden_access_services=array();
                    }


                    if($developer[0]->access_service_key)
                    {
                        return ['success'=>true,'apiId'=>$developer[0]->id,'access_services'=>$access_services,'forbidden_access_services'=>$forbidden_access_services,'user'=>$developer];
                    }

                    return ['success'=>false,'msg'=>'access service key closed'];

                }

                return ['success'=>false,'msg'=>'please,have any session info or guest mode for that your api access'];

            }


            return ['success'=>false,'msg'=>'please,have any session info or guest mode for that your api access'];


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


    public function userRequest($data=array())
    {
        if(count($data))
        {
            //query
            $query=DB::table($this->app->dbTable(['api']))->where("id","=",$data['user'][0]->id);

            //get data
            $take=$query->get();

            //get service request_number
            $service_request_number=$take[0]->service_request_number;

            if($service_request_number!==NULL)
            {
                $service_request_number=json_decode($service_request_number,true);

                if(!array_key_exists($data['service'],$service_request_number))
                {
                    $service_request_number[$data['service']]=1;
                }
                else
                {
                    $service_request_number[$data['service']]=$service_request_number[$data['service']]+1;
                }
            }
            else
            {
                $service_request_number=array();
                $service_request_number[$data['service']]=1;
            }


            //get all service request_number
            $all_service_request_number=$take[0]->all_service_request_number;

            if($all_service_request_number!==NULL)
            {
                $all_service_request_number=json_decode($all_service_request_number,true);

                if(!array_key_exists($data['service'],$all_service_request_number))
                {
                    $all_service_request_number[$data['service']]=1;
                }
                else
                {
                    $all_service_request_number[$data['service']]=$all_service_request_number[$data['service']]+1;
                }
            }
            else
            {
                $all_service_request_number=array();
                $all_service_request_number[$data['service']]=1;
            }


            //update
            $query->update(['request_number'=>DB::raw('request_number+1'),'all_request_number'=>DB::raw('all_request_number+1'),
                            'service_request_number'=>json_encode($service_request_number),'all_service_request_number'=>json_encode($all_service_request_number)]);

            //false
            if(!$query)
            {
               dd("request number error:");
            }
        }
    }
}
