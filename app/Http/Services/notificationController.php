<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;

class notificationController extends Controller
{
    public $request;
    public $app;
    public $admin;
    public $position;

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
        $this->position=array("success"=>"top-full-width","warning"=>"top-right");
    }

    public function success($data=array())
    {
        //predefined values
        $data['function']='success';
        $data['position']=$this->position['success'];

        //log info update
        $this->app->updateLogInfo($this->admin->id,['success_operations'=>1,'msg'=>$data['msg'],'query_json'=>json_encode(DB::getQueryLog()),'process_count_sql'=>count(DB::getQueryLog())]);
        DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['operations'=>DB::raw("operations+1"),'success_operations'=>DB::raw("success_operations+1"),
        'last_token'=>Input::get("_token"),'last_post'=>base64_encode(json_encode(Input::all()))]);

        DB::table($this->app->dbTable(['notifications']))->insert(['ccode'=>$this->admin->ccode,'user'=>$this->admin->id,
                                                                  'title'=>$this->app->getUsers($this->admin->id,'fullname')[0]->fullname,
                                                                   'content'=>$data['msg'],
                                                                    'created_at'=>time(),
                                                                    'status'=>1
                                                                  ]);

        if(\Session::has("updateLog"))
        {
            return app("\Query")->isTrue(DB::table($this->app->dbTable(['log_updated']))->insert(\Session("updateLog")),function() use ($data)
            {
                //session update log forget
                \Session::forget("updateLog");

                //return view
                return view("".config("app.admin_dirname").".notification",$data);
            });
        }


        //return view
        return view("".config("app.admin_dirname").".notification",$data);


    }


    public function warning($data=array())
    {
        //predefined values
        $data['function']='warning';
        $data['position']=$this->position['warning'];

        if(array_key_exists("manipulation",$data))
        {
            //log info update
            $this->app->updateLogInfo($this->admin->id,['msg'=>$data['msg'],'manipulation'=>1]);
        }
        else
        {
            //log info update
            $this->app->updateLogInfo($this->admin->id,['msg'=>$data['msg']]);
        }

        DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['operations'=>DB::raw("operations+1"),'fail_operations'=>DB::raw("fail_operations+1")]);
        DB::table($this->app->dbTable(['logs']))->where("userid","=",$this->admin->id)->where("userHash","=",$this->admin->hash)->orderBy("id","desc")->take(1)->update(['fail_operations'=>1]);

        //return view
        return view("".config("app.admin_dirname").".notification",$data);
    }


    public function manipulation($data=array())
    {
        //predefined values
        $data['function']='warning';
        $data['position']=$this->position['warning'];

        //log info update
        $this->app->updateLogInfo($this->admin->id,['msg'=>$data['msg']]);
        //update profil false notification manipulation
        $this->app->updateLogInfo($this->admin->id,['noauth_area_operations'=>1,'fail_operations'=>1,'manipulation'=>1]);
        DB::table($this->app->dbTable(['admin']))->where("id","=",$this->admin->id)->update(['operations'=>DB::raw("operations+1"),'fail_operations'=>DB::raw("fail_operations+1")]);
        DB::table($this->app->dbTable(['logs']))->where("userid","=",$this->admin->id)->where("userHash","=",$this->admin->hash)->orderBy("id","desc")->take(1)->update(['fail_operations'=>1]);

        //return view
        return view("".config("app.admin_dirname").".notification",$data);
    }


    public function desktopNotification()
    {
        $notifications=DB::table($this->app->dbTable(['notifications']))->where(function ($query)
        {
            $query->where("ccode","=",$this->admin->ccode);
            $query->where("status","=",1);
        });

        $getNotification=$notifications->orderBy("created_at","desc")->paginate(1);

        if(count($getNotification))
        {
            foreach ($getNotification as $result)
            {
                //delete
                $notifications->delete();

                //get photo
                $photo=$this->app->getUsers($result->user,['photo'])[0]->photo;

                //return view
                return view("".config("app.admin_dirname").".desktopnotification",['title'=>$result->title,'content'=>$result->content,'photo'=>$photo]);
            }

        }


    }

}
