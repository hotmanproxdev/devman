<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class validationController extends Controller
{
    public $request;
    public $app;
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
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>1]);
    }

    public function make($data)
    {
        $make=$this->check($data);

        if(is_array($make))
        {
            return ["result"=>false,"msg"=>$make['msg']];
        }

        return ["result"=>true];
    }



    public function check($data)
    {
        foreach ($data as $key=>$value)
        {
            foreach ($value as $field=>$index)
            {
                $list=$this->$key($index,$field);
                if($list['result']==false)
                {
                    return ['msg'=>$list['msg']];
                }

            }
        }

        return true;

    }


    public function str_empty($data,$field)
    {
        if((trim($data))=="")
        {
            return ['result'=>false,'msg'=>''.$field.' '.$this->data['empty_warning'].''];
        }

        return ['result'=>true];
    }


}
