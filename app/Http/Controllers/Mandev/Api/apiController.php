<?php

namespace App\Http\Controllers\Mandev\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Api\apiModel;
use DB;
use Validation;
use Notification;
use Input;
use Log;

class apiController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='api';
        public $model;
        public $validation;
        public $notification;

        public function __construct (Request $request,apiModel $model,Validation $validation,Notification $notification)
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
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>13,'admin'=>$this->admin]);
             //admin view
             $this->data['admin']=$this->admin;
             //get model
             $this->model=$model;
             //get validation
             $this->validation=$validation;
             //get notifications
             $this->notification=$notification;

        }

    public function getIndex ()
    {
        //get api accesses from query
        $this->data['apiAccesses']=$this->model->getApiAccesses();

        //system code distinct data
        $this->data['system_codes']=$this->model->getSystemCodes();

        //api1 return
        $api1chart=['A'=>1];

        //api2 return
        $api2chart=['A'=>1];

        //api 1 and 2 graph
        $this->data['linechart']=app("\Chart")->linechart(["chart_number"=>["1api","2api"],'data'=>[$api1chart,$api2chart]]);

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }


    public function postFilter()
    {
        //form filter tool register
        return app("\Filter")->data(function()
        {
            return redirect($this->request->header("Referer"));
        });

    }


    public function getNewapiuser()
    {
        //it just accepts ajax request
        return app("\Ajax")->control(function()
        {
            //content auth
            return app("\Role")->get(16,function()
            {
                //return view
                return view("".config("app.admin_dirname").".".$this->url_path.".newApiUser",$this->data);
            });

        });
    }

    public function postNewapiuser()
    {
        //it just accepts ajax request
        return app("\Ajax")->control(function()
        {
            //content auth
            return app("\Role")->get(17,function()
            {
                //validation control
                return $this->validation->make($this->validationRules("apiUser"),function()
                {
                    //same token control
                    return app("\Token")->valid(function()
                    {
                        //post data query is true
                        return app("\Query")->isTrue($this->model->insertNewUserApi(),function()
                        {
                            return $this->notification->success(['msg'=>$this->data['api_insert_user'],'title'=>$this->data['successful']]);
                        });
                    });
                });
            });


        });
    }

    public function getEdit()
    {
        //it just accepts ajax request
        return app("\Ajax")->control(function()
        {
            //content auth
            return app("\Role")->get(14,function()
            {
                //get user's api info
                $getUserApi=$this->model->getUserApi();

                //post data query is true
                return app("\Query")->isCountTrue($getUserApi,function() use ($getUserApi)
                {
                    //data passing user api
                    $this->data['getUserApi'] =$getUserApi;

                    //return view
                    return view("".config("app.admin_dirname").".".$this->url_path.".apiEdit",$this->data);
                });
            });

        });

    }


    public function postEdit()
    {
        //accept post in with ajax method
        return app("\Ajax")->control(function()
        {
            //content auth
            return app("\Role")->get(15,function()
            {
                //same token control
                return app("\Token")->valid(function()
                {
                    //validation control
                    return $this->validation->make($this->validationRules("apiUser"),function()
                    {
                        //post data query is true
                        return app("\Query")->isTrue($this->model->updateUserApi(),function()
                        {
                            return $this->notification->success(['msg'=>$this->data['api_update_user'],'title'=>$this->data['successful']]);
                        });
                    });

                });

            });

        });

    }


    public function getLogs()
    {
        //return view
        return 'hello';
    }


    public function validationRules($key)
    {

        if($key=="apiUser")
        {
            $rules=array(

                "str_empty"=>["Apikey"=>[Input::get("apikey")],
                              $this->data['daily_request_limit']=>[Input::get("request")],
                              ],
                "str_select"=>[
                                Input::get("ccode")=>($this->admin->system_number==0) ? ['develop','guest'] : ['guest'],
                                Input::get("access_service_key")=>[1,0],
                                Input::get("request_type")=>[1,0]
                              ],
                "str_nopostkey"=>($this->admin->system_number==0) ? [] :['system_ccode',
                                                                         'api_develop_url_filter',
                                                                         'api_coding_delete',
                                                                         'api_coding_update',
                                                                         'api_coding_insert',
                                                                         'hash_limit',
                                                                         'hash_number'

                                                                        ]

            );
        }

        return $rules;
    }


}
