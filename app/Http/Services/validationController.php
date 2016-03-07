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
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function make($data,$callback)
    {
        $make=$this->check($data);

        if(count($make))
        {
            //validation false
            return app("\Notification")->warning(['msg'=>$make['msg'],'title'=>$this->data['error'],'manipulation'=>true]);
        }

        if(is_callable($callback))
        {
            return call_user_func($callback);
        }
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

        return [];


    }


    public function str_empty($data,$field)
    {
        if((trim($data[0]))=="")
        {
            return ['result'=>false,'msg'=>''.$field.' '.$this->data['empty_warning'].''];
        }

        return ['result'=>true];
    }


    public function str_select($data,$field)
    {
        if(!in_array($field,$data))
        {
            return ['result'=>false,'msg'=>''.$field.' '.$this->data['select_warning'].''];
        }

        return ['result'=>true];
    }


    public function minChar($data,$field)
    {

        if(strlen($data[0])<$data[1])
        {
            return ['result'=>false,'msg'=>''.$field.' '.$this->data['minchar_warning'].''];
        }

        return ['result'=>true];
    }

    public function str_nopostkey($data)
    {
        if(array_key_exists($data,\Input::all()))
        {
            return ['result'=>false,'msg'=>''.$data.' '.$this->data['nopost_warning'].''];
        }

        return ['result'=>true];
    }



    /*
    |--------------------------------------------------------------------------
    | Application Test Validate Rules
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function validationRules($key)
    {
        if($key=="postIndex")
        {
            $rules=array(
                "str_empty"=>[$this->data['login_name']=>[Input::get("username")],
                    $this->data['username']=>[Input::get("fullname")],
                    $this->data['mail']=>[Input::get("email")]
                ]
            );
        }


        if($key=="postChangepassword")
        {
            $rules=array(

                "str_empty"=>[$this->data['new_password']=>[Input::get("password")],
                    $this->data['renew_password']=>[Input::get("repassword")]
                ],

                "minChar"=>  [$this->data['new_password']=>[Input::get("password"),8],
                    $this->data['renew_password']=>[Input::get("repassword"),8]
                ],

                "str_select"=>[Input::get("ccode")=>['develop','guest']]
            );
        }

        return $rules;
    }


}
