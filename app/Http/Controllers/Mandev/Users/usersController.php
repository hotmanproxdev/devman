<?php

namespace App\Http\Controllers\Mandev\Users;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Users\usersModel;
use DB;
use Validation;
use Notification;
use Input;

class usersController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='users';
        public $model;
        public $validation;
        public $notification;

        public function __construct (Request $request,usersModel $model,Validation $validation,Notification $notification)
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
             $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>$this->admin->lang]);
             //menu statu
             $this->data['menu']=$this->app->menuStatu('normal');
             //page role
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>2,'admin'=>$this->admin]);
             //admin view
             $this->data['admin']=$this->admin;
             //get model
             $this->model=$model;
             //get validation
             $this->validation=$validation;
             //get notifications
             $this->notification=$notification;

        }


    /*
    |--------------------------------------------------------------------------
    | Application Users Default Page
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getIndex (\Time $time,\Api $api)
    {
        //get all users
        $this->data['getUsers']=$this->model->getUsers();

        //time check process
        $this->data['time']=$time;

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }


    /*
    |--------------------------------------------------------------------------
    | Application Users New User Form Process
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */


    public function getNewuser()
    {
        if($this->request->ajax())
        {
            //get user roles
            $this->data['roles']=$this->app->getUserRoles(['admin'=>$this->admin]);

            //return view
            return view("".config("app.admin_dirname").".".$this->url_path.".newUser",$this->data);
        }

        return redirect("".strtolower(config("app.admin_dirname"))."/logout");

    }

    /*
    |--------------------------------------------------------------------------
    | Application Users New User Post Process
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function postNewuser()
    {
        if($this->request->ajax())
        {
            //validation check
            $validation=$this->validation->make($this->validationRules("postNewuser"));

            //validation false
            if(!$validation['result'])
            {
                //validation false notification
                return $this->notification->warning(['msg'=>$validation['msg'],'title'=>$this->data['error']]);
            }

            //additional fields
            $_POST['created_at']=time();
            $_POST['photo']='default.png';
            $_POST['lang']=config("app.default_lang");
            $_POST['password']=$this->app->passwordHash($_POST['password']);
            $_POST['role']=implode("-",$_POST['role_assign']);
            $default_roles=explode("-",$_POST['default_roles']);
            $_POST['system_number']=$default_roles[0];
            $_POST['system_name']=$this->app->getUserRoles(['default_roles'=>$default_roles[0]])[0]->role_name;
            $_POST['created_by']=$this->admin->id;

            //update ccode except developer
            if($this->admin->system_number>0)
            {
                $_POST['ccode']=$this->admin->ccode;
            }


            //new user post
            if($this->model->newUserCreate($this->app->getvalidPostKey($_POST,['_token','role_assign','default_roles'])))
            {
                //new user sql true notification
                return $this->notification->success(['msg'=>$this->data['new_user_post_true'],'title'=>$this->data['new_user_post_header']]);
            }

            //new user sql false notification
            return $this->notification->warning(['msg'=>$this->data['new_user_post_false'],'title'=>$this->data['new_user_post_header']]);

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Application Users Validate Rules
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function validationRules($key)
    {
        if($key=="postNewuser")
        {
            $rules=array(
                "str_empty"=>[$this->data['new_user_ccode']=>[Input::get("ccode")],
                    $this->data['new_user_login_name']=>[Input::get("username")],
                    $this->data['new_user_login_password']=>[Input::get("password")],
                    $this->data['new_user_email']=>[Input::get("email")],
                    $this->data['new_user_fullname']=>[Input::get("fullname")]
                ]
            );
        }


        return $rules;
    }
}
