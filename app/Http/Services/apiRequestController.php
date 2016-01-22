<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class apiRequestController extends Controller
{

    public $request;
    public $apiUrl;
    protected $header=['codingRequest:1','device:web','mode:select','company:teknasyon','Content-Type: application/json'];

    public function __construct (Request $request)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //baseUrl
        $this->apiUrl='http://'.$this->request->getHttpHost().''.$this->request->getBaseUrl().'/api/services';


    }

    public function get($data=array(),$hash=false)
    {
        if(count($data))
        {
            if($hash)
            {
                $this->header[]='hash:'.$hash;
            }

            //method send
            if(array_key_exists("method",$data))
            {
                $this->header[]='method:'.$data['method'];
            }
            else
            {
                //default method
                $this->header[]='method:get';
            }

            $init = curl_init();
            $url=''.$this->apiUrl.'/'.$data['service'].'';

            //update for fields
            if(array_key_exists("update",$data))
            {
                $this->header['update']='update:'.json_encode($data['update']);
            }

            //select for fields
            if(array_key_exists("select",$data))
            {
                $this->header['select']='select:'.json_encode($data['select']);
            }



            curl_setopt($init,CURLOPT_URL,$url);

            //post data
            $this->header[]='POSTDATA:'.json_encode(['_token'=>'']);
            if(array_key_exists("post",$data))
            {
                //x-csrf-token
                $this->header[]='X-CSRF-TOKEN:'.$data['post']['_token'];
                $this->header[]='POSTDATA:'.json_encode($data['post']);
            }


            curl_setopt($init,CURLOPT_HTTPHEADER,$this->header);
            curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
            $data = curl_exec($init);
            curl_close($init);

            return $data;
            return json_decode($data,true);
        }


    }

}
