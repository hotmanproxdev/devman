<?php

namespace App\Http\Controllers\Mandev\Profile;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Profile\profileModel;
use DB;
use Input;
use Notification;
use Validation;
use Time;


class profileController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='profile';
        public $model;
        public $notification;
        public $validation;
        public $time;

        public function __construct (Request $request,profileModel $model,Notification $notification,Validation $validation,Time $time)
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
             //admin data passing
             $this->data['admin']=$this->admin;
             //page role
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>3,'admin'=>$this->admin]);
             //get page model
             $this->model=$model;
             //notification
             $this->notification=$notification;
             //validation
             $this->validation=$validation;
            //time get
            $this->time=$time;

        }


    /*
    |--------------------------------------------------------------------------
    | Application Profil Index
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getIndex ($id=false)
    {
        //data control for page access
        return app("\Data")->control(['admin',$id],function() use ($id)
        {
            if(($id) AND ($this->admin->id!=$id))
            {
                //other profile info for id variable
                if(($this->admin->system_number==0) OR ($this->admin->system_number==1 AND $this->admin->ccode==$this->app->getUsers($id,['ccode'])[0]->ccode))
                {
                    //check seeing other profil
                    if($this->admin->system_number==1)
                    {
                        //page role
                        $this->data['pageRole']=$this->app->pageRole(['pageRole'=>6,'admin'=>$this->admin]);
                    }

                    //userid
                    $admin=$this->app->admin($id);

                    //user viewed
                    $this->data['admin']=$admin;

                    //hidden input adding condition
                    $this->data['hidden_input']=true;

                    //variables will be sent
                    $this->data['last_login_time']=$this->time->getPassing($this->admin->last_login_time)->output;

                    //get logs
                    $this->data['logs']=$this->app->getLogs(['id'=>$admin->id]);

                    //get roles
                    $this->data['roles']=$this->app->getUserRoles(['admin'=>$admin]);
                }
                else
                {
                    return abort("404");
                }

            }
            else
            {
                //variables will be sent
                $this->data['last_login_time']=$this->time->getPassing($this->admin->last_login_time)->output;

                //get logs
                $this->data['logs']=$this->app->getLogs(['id'=>$this->admin->id]);

                //get roles
                $this->data['roles']=$this->app->getUserRoles(['admin'=>$this->admin]);

                //hidden input adding condition
                $this->data['hidden_input']=false;
            }


            //return view
            return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
        });

    }


    /*
    |--------------------------------------------------------------------------
    | Application Profile Post Index
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function postIndex()
    {
        //same token one process
        return app("\Token")->valid(function()
        {
            return $this->validation->make($this->validationRules("postIndex"),function()
            {
                //default admin
                $userid=$this->admin->id;

                //updating other user for developer
                if(array_key_exists("hidden_input",$_POST))
                {
                    $userid=Input::get("hidden_input");

                    //manager
                    if(($this->admin->system_number==1) AND ($this->admin->ccode!==$this->app->getUsers($userid,['ccode'])[0]->ccode))
                    {
                        return $this->notification->manipulation(['msg'=>$this->data['update_profile_manipulation'],'title'=>$this->data['update_profile_title_warning']]);
                    }

                    //check users role for personal info button
                    if(!$this->app->pageRole(['pageRole'=>8,'admin'=>$this->admin]))
                    {
                        //update profil false notification
                        return $this->notification->warning(['msg'=>$this->data['noauth'],'title'=>$this->data['error']]);
                    }
                }

                //update profil for session admin
                if($this->model->updateProfile(Input::all(),$userid))
                {
                    //update profil notification
                    return $this->notification->success(['msg'=>$this->data['update_profile_msg_success'],'title'=>$this->data['update_profile_title_success']]);
                }

                //update profil false notification
                return $this->notification->warning(['msg'=>$this->data['update_profile_msg_warning'],'title'=>$this->data['update_profile_title_warning']]);
            });

        });


    }


    /*
    |--------------------------------------------------------------------------
    | Application Profile Change Password
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function postChangepassword()
    {
        //validation check
        return $this->validation->make($this->validationRules("postChangepassword"),function()
        {
            //check new password and renew password
            if(Input::get("password")==Input::get("repassword"))
            {
                //default admin
                $userid=$this->admin->id;

                //updating other user for developer
                if(array_key_exists("hidden_input",$_POST))
                {
                    $userid=Input::get("hidden_input");

                    //check users role for personal change password button
                    if(!$this->app->pageRole(['pageRole'=>10,'admin'=>$this->admin]))
                    {
                        //update profil false notification
                        return $this->notification->warning(['msg'=>$this->data['noauth'],'title'=>$this->data['error']]);
                    }
                }


                //manager
                if(($this->admin->system_number==1) AND ($this->admin->ccode!==$this->app->getUsers($userid,['ccode'])[0]->ccode))
                {
                    return $this->notification->manipulation(['msg'=>$this->data['update_profile_manipulation'],'title'=>$this->data['update_profile_title_warning']]);
                }


                if($this->model->changePassword(Input::get("password"),$userid))
                {
                    //change password notification
                    return $this->notification->success(['msg'=>$this->data['change_password_msg_success'],'title'=>$this->data['change_password_title_success']]);
                }

                return false;
            }

            //not same for password warning
            return $this->notification->warning(['msg'=>$this->data['change_password_not_same_warning_msg'],'title'=>$this->data['change_password_not_same_warning_title']]);
        });

    }


    /*
    |--------------------------------------------------------------------------
    | Application Profile Photo Upload
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function postPhotoupload(\FileUpload $file)
    {

        //default admin
        $userid=$this->admin->id;

        //updating other user for developer
        if(array_key_exists("hidden_input",$_POST))
        {
            $userid=Input::get("hidden_input");

            //check users role for personal change password button
            if(!$this->app->pageRole(['pageRole'=>11,'admin'=>$this->admin]))
            {
                //update profil false notification
                return $this->notification->warning(['msg'=>$this->data['noauth'],'title'=>$this->data['error']]);
            }
        }

        //manager
        if(($this->admin->system_number==1) AND ($this->admin->ccode!==$this->app->getUsers($userid,['ccode'])[0]->ccode))
        {
            return $this->notification->manipulation(['msg'=>$this->data['update_profile_manipulation'],'title'=>$this->data['update_profile_title_warning']]);
        }

        //file upload
        $upload=$file->upload(['input'=>Input::all(),'name'=>'photo','path'=>'upload/admin_profil_pictures']);

        //result true upload
        if($upload['result'])
        {

           if($this->model->uploadUpdate($upload['file'],$userid))
           {
               //file upload notification
               return $this->notification->success(['msg'=>$this->data['file_upload_msg_success'],'title'=>$this->data['file_upload_title_success']]);
           }

            //file upload notification false sql
            return $this->notification->warning(['msg'=>$this->data['file_upload_msg_warning'],'title'=>$this->data['file_upload_title_warning']]);
        }

        //file upload notification false tmp
        return $this->notification->warning(['msg'=>$this->data['file_upload_false_msg_warning'],'title'=>$this->data['file_upload_false_title_warning']]);

    }


    /*
   |--------------------------------------------------------------------------
   | Application Profile Role Update
   |--------------------------------------------------------------------------
   |
   | Here is where you can register all of the routes for an application.
   | It's a breeze. Simply tell Laravel the URIs it should respond to
   | and give it the controller to call when that URI is requested.
   |
   */

    public function postRoleupdate()
    {

        //manipulation
        if(!in_array($this->admin->system_number,$this->app->systemNumberCheck()))
        {
            return $this->notification->manipulation(['msg'=>$this->data['update_profile_manipulation'],'title'=>$this->data['update_profile_title_warning']]);
        }

        //default admin
        $userid=$this->admin->id;

        //updating other user for developer
        if(array_key_exists("hidden_input",$_POST))
        {
            $userid=Input::get("hidden_input");


            //check users role for personal role button
            if(!$this->app->pageRole(['pageRole'=>12,'admin'=>$this->admin]))
            {
                //update profil false notification
                return $this->notification->warning(['msg'=>$this->data['noauth'],'title'=>$this->data['error']]);
            }
        }
        else
        {
            //check users role for personal role button
            if(!$this->app->pageRole(['pageRole'=>9,'admin'=>$this->admin]))
            {
                //update profil false notification
                return $this->notification->warning(['msg'=>$this->data['noauth'],'title'=>$this->data['error']]);
            }
        }



        //manager
        if(($this->admin->system_number==1) AND ($this->admin->ccode!==$this->app->getUsers($userid,['ccode'])[0]->ccode))
        {
            return $this->notification->manipulation(['msg'=>$this->data['update_profile_manipulation'],'title'=>$this->data['update_profile_title_warning']]);
        }



        if($this->model->roleUpdate($_POST,$userid))
        {
            //file upload notification
            return $this->notification->success(['msg'=>$this->data['profile_role_msg_success'],'title'=>$this->data['profile_role_title_success']]);
        }

        //file upload notification
        return $this->notification->warning(['msg'=>$this->data['profile_role_msg_warning'],'title'=>$this->data['error']]);
    }


    /*
    |--------------------------------------------------------------------------
    | Application Profile Validate Rules
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
                             ]
            );
        }

        return $rules;
    }
}
