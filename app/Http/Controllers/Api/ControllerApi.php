<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\LogApi as LogApi;

class ControllerApi extends Controller
{

    public $request;
    public $app;
    protected $headers=['device','mode','company'];
    protected $device=['ios','android','web'];
    protected $mode=['select'];
    protected $company=['teknasyon'];
    public $log;

    public function __construct (Request $request,LogApi $logApi)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //log api system
        $this->log=$logApi;

    }

    public function services()
    {
        //return services from app
        return $this->app->services(true);
    }

    public function developer ($apiHash=false)
    {
        $condHash=false;

        if((array_key_exists("key",\Input::all())) AND (array_key_exists("hash",\Input::all())))
        {
            $condHash=true;
        }


        if(($apiHash) AND (!$condHash))
        {
            $developer=DB::table($this->app->dbTable(['api']))->where("ccode","=",config("app.api_ccode"))->where("hash","=",$apiHash)->get();
            $access_point=0;
        }
        else
        {
            $developer=DB::table($this->app->dbTable(['api']))->where("ccode","=",config("app.api_ccode"))->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"))->get();
            $access_point=1;
        }


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
                $this->log->set(['condHash'=>$condHash,'access_point'=>$access_point,'service_closed'=>0,'ccode'=>'develop','key'=>$developer[0]->id,'msg'=>'access']);
                return ['success'=>true,'apiId'=>$developer[0]->id,'access_services'=>$access_services,'forbidden_access_services'=>$forbidden_access_services,'user'=>$developer];
            }

            $this->log->set(['condHash'=>$condHash,'access_point'=>$access_point,'service_closed'=>1,'ccode'=>'develop','msg'=>'your service access has been closed by manager']);
            return ['success'=>false,'msg'=>'access service key closed'];

        }

        return ['success'=>false,'condHash'=>$condHash,'access_point'=>$access_point];


    }


    public function guest ()
    {
            if(array_key_exists("key",\Input::all()) and array_key_exists("hash",\Input::all()))
            {
                $ip=$this->request->ip();
                if($this->request->ip()=="::1")
                {
                    $ip='127.0.0.1';
                }


                $develop=DB::table($this->app->dbTable(['api']))->
                where("ccode","=","guest")->where("ip","=",$ip)->where("apikey","=",\Input::get("key"))->where("standart_key","=",\Input::get("hash"));

                $developer=$develop->get();

                if(count($developer))
                {
                    if($this->request->header("select") or $this->request->header("update") or $this->request->header("where") or $this->request->header("insert"))
                    {
                        return ['success'=>false,'msg'=>'please,dont make manipulation because of that you dont have select permission'];
                    }
                    //hash generate
                    $hash=$this->app->getApiHash(['ccode'=>$developer[0]->system_ccode,'ip'=>$this->request->ip(),'key'=>\Input::get("key")]);

                    //hash number reset
                    if(date("Ymd",$developer[0]->created_at)<date("Ymd"))
                    {
                        if($developer[0]->service_request_number!==NULL)
                        {
                            $service_request_number=json_decode($developer[0]->service_request_number,true);
                            foreach ($service_request_number as $skey=>$sval)
                            {
                                $update_service_request_number[$skey]=0;
                            }

                            $develop->update(['created_at'=>time(),'hash'=>$hash,'standart_key'=>$this->app->getApiStandartKey($developer[0]->id),'hash_number'=>0,'request_number'=>0,
                                'service_request_number'=>json_encode($update_service_request_number)]);
                        }
                        else
                        {
                            $develop->update(['created_at'=>time(),'hash'=>$hash,'standart_key'=>$this->app->getApiStandartKey($developer[0]->id),'hash_number'=>0,'request_number'=>0]);
                        }

                    }

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
                        $this->log->set(['service_closed'=>0,'ccode'=>'guest','key'=>$developer[0]->id,'msg'=>'access']);
                        return ['success'=>true,'apiId'=>$developer[0]->id,'access_services'=>$access_services,'forbidden_access_services'=>$forbidden_access_services,'user'=>$developer];
                    }

                    return ['success'=>false,'msg'=>'access service key closed'];

                }

                return ['success'=>false,'msg'=>'please,you must have any develop session info or guest mode conditions for that your api access'];

            }


            return ['success'=>false,'msg'=>'please,you must have any develop session info or guest mode conditions for that your api access'];


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

                if(!is_array($service_request_number))
                {
                    $service_request_number=[];
                }

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

                if(!is_array($all_service_request_number))
                {
                    $all_service_request_number=[];
                }

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


    public function guest_forbidden_add($id)
    {
        foreach ($this->app->dbTable(['all']) as $key=>$val)
        {
            $list[]=$key;
        }

        return DB::table($this->app->dbTable(['api']))->where("id","=",$id)->update(['created_at'=>DB::raw('created_at+1'),'forbidden_access_services'=>implode("-",$list)]);
    }
}
