<?php

namespace App\Http\Controllers\Mandev\Apicustom;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Apicustom\apicustomModel;
use App\Http\Controllers\Mandev\Apicustom\source\sourceController as Source;
use DB;
use Validation;
use Notification;
use Input;

class apicustomController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='apicustom';
        public $model;
        public $validation;
        public $notification;
        public $source;
        public $api;

        public function __construct (Request $request,apicustomModel $model,Validation $validation,Notification $notification,Source $source)
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
             $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);
             //admin view
             $this->data['admin']=$this->admin;
             //get model
             $this->model=$model;
             //get validation
             $this->validation=$validation;
             //get notifications
             $this->notification=$notification;
             //get source
             $this->source=$source;
             //get api services
             $this->api=app("Api")->version(config("app.apiversion"));

        }

    public function getIndex ()
    {
        //get apicustom list
        $this->data['query'] = $this->source->data("apicustom")->get("get");

        //ajax return view
        $view=view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);

        if($this->request->ajax())
        {
            $sections = $view->renderSections();
            return $sections['tsql'];
        }

        return $view;

        //return view
        return view("".config("app.admin_dirname").".".$this->url_path.".main",$this->data);
    }


    public function postApicustomfilter()
    {
        return app("\Filter")->data(function()
        {
            return $this->getIndex();
        });
    }


    public function postProcessapicustom()
        {
            //accept post in with ajax method
            return app("\Ajax")->control(function()
            {
                //content auth
                return app("\Role")->get(1,function()
                {
                    //same token control
                    return app("\Token")->valid(function()
                    {
                        //validation control
                        return $this->validation->make([],function()
                        {
                            //post data query is true
                            return app("\Query")->isTrue($this->model->postprocessapicustom(),function()
                            {
                                return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                            });
                        });

                    });

                });

            });

        }

    public function getNewapicustom()
        {
            //it just accepts ajax request
            return app("\Ajax")->control(function()
            {
                //content auth
                return app("\Role")->get(1,function()
                {
                    //new name
                    $this->data['name']='apicustom';

                    //return view
                    return view("".config("app.admin_dirname").".tsqlnew",$this->data);
                });
            });
        }

        public function postApicustomnew()
        {
            //accept post in with ajax method
            return app("\Ajax")->control(function()
            {
                //content auth
                return app("\Role")->get(1,function()
                {
                    //same token control
                    return app("\Token")->valid(function()
                    {
                        //validation control
                        return $this->validation->make([],function()
                        {
                            //post data query is true
                            return app("\Query")->isTrue($this->model->postApicustomnew(),function()
                            {
                                return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
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
            return app("\Role")->get(1,function()
            {
                //edit name
                $this->data['name']='apicustom';

                //return view
                return view("".config("app.admin_dirname").".tsqledit",$this->data);
            });
        });
    }


    public function postApicustom()
    {
        //accept post in with ajax method
        return app("\Ajax")->control(function()
        {
            //content auth
            return app("\Role")->get(1,function()
            {
                //same token control
                return app("\Token")->valid(function()
                {
                    //validation control
                    return $this->validation->make([],function()
                    {
                        //post data query is true
                        return app("\Query")->isTrue($this->model->postApicustom(),function()
                        {
                            return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                        });
                    });

                });

            });

        });

    }




    public function validationRules($key)
    {
        if($key=="postManagersnew")
        {
            $rules=array(
                    "str_empty"=>[$this->data['username']=>[Input::get("username")]
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
