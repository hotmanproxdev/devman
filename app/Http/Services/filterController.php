<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class filterController extends Controller
{

    public $request;
    public $app;
    public $data;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request method
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function data($callback)
    {
        $val=false;

        //post filter data adress info
        \Input::merge(array('request' => $this->request->getPathInfo()));

        $log=\DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['last_token'=>\Input::get("_token"),
                                                                                           'last_post'=>base64_encode(json_encode(\Input::all())),
                                                                                           'last_filter_data'=>1]);

        if($log)
        {
            $postfilterdata=array();
            foreach ($this->app->getvalidPostKey(\Input::all(),['_token','filter','request']) as $key=>$value)
            {
                if(($value!=="none") and (strlen(trim($value))))
                {
                    $postfilterdata[$key]=$value;
                }
            }

            if(count($postfilterdata))
            {
                \Session::put("filterdata",$postfilterdata);
            }

            $val=true;
        }


        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }


        //redirect to logout
        dd("Filter register class occured an error");


    }


    public function get($data=array())
    {
        $list=array();
        $option=array();
        $object=array();
        $option[]='<option value="none">'.$data['none'].'</option>';
        $object[]='none';

        if(array_key_exists("data",$data))
        {

            foreach ($data['data'] as $result)
            {
                $option[]='<option>'.$result->system_ccode.'</option>';
                $object[]=$result->system_ccode;
            }
        }
        else
        {

            foreach ($data as $key=>$result)
            {
                if($key!="none" && $key!="name")
                {
                    $option[]='<option>'.$result.'</option>';
                    $object[]=$result;
                }

            }
        }


        if(\Session::has("filterdata"))
        {
            //$list[]='<option>'.\Session::get("filterdata")[$data['name']].'</option>';
            if(array_key_exists($data['name'],\Session::get("filterdata")))
            {
                $list[]='<option>'.\Session::get("filterdata")[$data['name']].'</option>';
                foreach ($object as $obj)
                {
                    if($obj!=\Session::get("filterdata")[$data['name']])
                    {
                        if($obj!="none")
                        {
                            $list[]='<option>'.$obj.'</option>';
                        }
                    }
                }

                if($data['none']!=\Session::get("filterdata")[$data['name']])
                {
                    $list[]='<option>'.$data['none'].'</option>';
                }

            }
            else
            {
                $list=$option;
            }
        }
        else
        {
            $list=$option;
        }

        return implode("",$list);
    }
}
