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
                                                                                           'last_filter_data'=>time()]);

        if($log)
        {
            $postfilterdata=array();
            foreach ($this->app->getvalidPostKey(\Input::all(),['_token','filter','request']) as $key=>$value)
            {
                if((strlen(trim($value))))
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

        if($data['type']=="select")
        {
            $option[]='<option value="none">'.$data['none'].'</option>';
            $object[]='none';
        }



        if(array_key_exists("data",$data))
        {

            foreach ($data['data'] as $result)
            {
                $option[]='<option value="'.$result->$data['field'].'">'.$result->$data['field'].'</option>';
                $data[$result->$data['field']]=$result->$data['field'];
                $object[]=$result->$data['field'];
            }
        }
        else
        {
            if($data['type']=="select")
            {

                foreach ($data as $key => $result) {
                    if ($key != "none" && $key != "name" && $key != "type" && $key != "field") {
                        $option[] = '<option value="' . $key . '">' . $result . '</option>';
                        $object[] = $result;
                    }

                }
            }


            if($data['type']=="input")
            {

                $option[] = '<input type="text" name="'.$data['name'].'" class="'.$data['class'].'" placeholder="' . $data['placeholder'] . '">';
                $object[] = $data['name'];
            }
        }


        if(\Session::has("filterdata"))
        {
            if(array_key_exists($data['name'],\Session::get("filterdata")))
            {
                $filterdata=\Session::get("filterdata");

                if($data['type']=="select")
                {
                    $list[]='<option value="'.$filterdata[$data['name']].'">'.$data[$filterdata[$data['name']]].'</option>';
                    foreach ($object as $obj)
                    {
                        if($obj!=$data[$filterdata[$data['name']]])
                        {
                            if($obj!="none")
                            {
                                $list[]='<option value="'.array_search($obj,$data).'">'.$obj.'</option>';
                            }
                        }
                    }

                    if($data['none']!=$data[$filterdata[$data['name']]])
                    {
                        $list[]='<option value="none">'.$data['none'].'</option>';
                    }
                }

                if($data['type']=="input")
                {
                    $list[] = '<input type="text" name="'.$data['name'].'" class="'.$data['class'].'" value="' . $filterdata[$data['name']] . '">';
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



    public function session()
    {
        $val=false;

        if(\Session::has("filterdata"))
        {
            $val=true;
        }

       return $val;
    }

    public function getData()
    {
        $list=[];

        if(is_array(\Session("filterdata")))
        {
            foreach (\Session("filterdata") as $key=>$value)
            {
                if($value!="none")
                {
                    $list[$key]=$value;
                }
            }
        }


        return $list;
    }

}
