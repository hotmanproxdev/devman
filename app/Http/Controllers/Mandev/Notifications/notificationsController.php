<?php

namespace App\Http\Controllers\Mandev\Notifications;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Notifications\notificationsModel;
use App\Http\Controllers\Mandev\Notifications\source\sourceController as Source;
use DB;
use Validation;
use Notification;
use Input;

class notificationsController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='notifications';
        public $model;
        public $validation;
        public $notification;
        public $source;
        public $api;

        public function __construct (Request $request,notificationsModel $model,Validation $validation,Notification $notification,Source $source)
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


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page Index
        |--------------------------------------------------------------------------
        |
        | Here is where you can register main index of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function getIndex ()
        {
            //get notifications list
            $this->data['query'] = $this->source->data("notifications")->get("get");

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


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page New Button Process Ajax
        |--------------------------------------------------------------------------
        |
        | Here is where you can register new process ajax of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function getNewnotifications()
        {
            //it just accepts ajax request
            return app("\Ajax")->control(function()
            {
                //content auth
                return app("\Role")->get(1,function()
                {
                    //new name
                    $this->data['name']='notifications';

                    //return view
                    return view("".config("app.admin_dirname").".tsqlnew",$this->data);
                });
            });
        }


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page New Button Post
        |--------------------------------------------------------------------------
        |
        | Here is where you can register new button post of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function postNotificationsnew()
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
                            return app("\Query")->isTrue($this->model->postNotificationsnew(),function()
                            {
                                return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                            });
                        });

                    });

                });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page Edit Ajax Process
        |--------------------------------------------------------------------------
        |
        | Here is where you can register edit ajax of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function getEditnotifications()
        {
            //it just accepts ajax request
            return app("\Ajax")->control(function()
            {
                //content auth
                return app("\Role")->get(1,function()
                {
                    //edit name
                    $this->data['name']='notifications';

                    //return view
                    return view("".config("app.admin_dirname").".tsqledit",$this->data);
                });
            });
        }



        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page Edit Post
        |--------------------------------------------------------------------------
        |
        | Here is where you can register page edit post of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function postEditnotifications()
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
                            return app("\Query")->isTrue($this->model->postNotifications(),function()
                            {
                                return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                            });
                        });

                    });

                });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page Post Filter
        |--------------------------------------------------------------------------
        |
        | Here is where you can register post filter of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function postNotificationsfilter()
        {
           return app("\Filter")->data(function()
           {
               return $this->getIndex();
           });
        }


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page Process Filter
        |--------------------------------------------------------------------------
        |
        | Here is where you can register process filter of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function postProcessnotifications()
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
                            return app("\Query")->isTrue($this->model->postprocessnotifications(),function()
                            {
                                return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                            });
                        });

                    });

                });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Application Api Custom Get Page Validation Rules
        |--------------------------------------------------------------------------
        |
        | Here is where you can register validation rules of the page for an application.
        | It's a breeze. Simply tell Laravel the URIs it should respond to
        | and give it the controller to call when that URI is requested.
        |
        */
        public function validationRules($key)
        {
            if($key=="postManagersnew")
            {
                $rules=array(
                        "str_empty"=>[

                                        //$this->data['username']=>[Input::get("username")]
                                     ],

                                     "str_select"=>[

                                                        //Input::get("parent")=>[0=>$this->data['mainMenu']]+$this->model->getMainMenus(),
                                                        //Input::get("status")=>[0=>$this->data['passive'],1=>$this->data['active']]

                                                    ]
                    );
            }

                return $rules;
        }
}
