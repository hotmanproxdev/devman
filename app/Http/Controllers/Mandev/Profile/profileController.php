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

class profileController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='profile';
        public $model;
        public $notification;

        public function __construct (Request $request,profileModel $model,Notification $notification)
        {
             //page protector
             $this->middleware('auth');
             //request class
             $this->request=$request;
             //base service provider
             $this->app=app()->make("Base");
             //page lang
             $this->data=$this->app->getLang(['url_path'=>$this->url_path,'lang'=>1]);
             //menu statu
             $this->data['menu']=$this->app->menuStatu('normal');
             //admin data
             $this->admin=$this->app->admin();
             //admin data passing
             $this->data['admin']=$this->admin;
             //page role
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin->role]);
             //get page model
             $this->model=$model;
             //notification
             $this->notification=$notification;

        }

    public function getIndex ()
    {
        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }

    public function postIndex()
    {
        //update profil for session admin
        if($this->model->updateProfile(Input::all()))
        {
            //update profil notification
            return $this->notification->send(['msg'=>$this->data['update_profile_msg_success'],'title'=>$this->data['update_profile_title_success']]);
        }

        //update profil false notification
        return $this->notification->send(['msg'=>$this->data['update_profile_msg_warning'],'title'=>$this->data['update_profile_title_warning'],'position'=>'top-right', 'function'=>'warning']);
    }

    public function postChangepassword()
    {
        //check new password and renew password
        if(Input::get("password")==Input::get("repassword"))
        {
            if($this->model->changePassword(Input::get("password")))
            {
                //change password notification
                return $this->notification->send(['msg'=>$this->data['change_password_msg_success'],'title'=>$this->data['change_password_title_success']]);
            }

            return false;
        }

        //not same for password warning
        return $this->notification->send(['msg'=>$this->data['change_password_not_same_warning_msg'],'title'=>$this->data['change_password_not_same_warning_title'],'position'=>'top-right', 'function'=>'warning']);

    }


    public function postPhotoupload(\FileUpload $file)
    {
        //file upload
        $upload=$file->upload(['input'=>Input::all(),'name'=>'photo','path'=>'upload/admin_profil_pictures']);

        //result true
        if($upload['result'])
        {
           if($this->model->uploadUpdate($upload['file']))
           {
               //file upload notification
               return $this->notification->send(['msg'=>$this->data['file_upload_msg_success'],'title'=>$this->data['file_upload_title_success']]);
           }

            //file upload notification false sql
            return $this->notification->send(['msg'=>$this->data['file_upload_msg_warning'],'title'=>$this->data['file_upload_title_warning'],'position'=>'top-right', 'function'=>'warning']);
        }

        //file upload notification false tmp
        return $this->notification->send(['msg'=>$this->data['file_upload_false_msg_warning'],'title'=>$this->data['file_upload_false_title_warning'],'position'=>'top-right', 'function'=>'warning']);

    }
}
