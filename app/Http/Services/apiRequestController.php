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

    public function get($data=array())
    {
        if(count($data))
        {
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
            curl_setopt($init,CURLOPT_HTTPHEADER,$this->header);
            curl_setopt($init,CURLOPT_RETURNTRANSFER,true);
            $data = curl_exec($init);
            curl_close($init);

            return json_decode($data,true);
        }


    }

}
