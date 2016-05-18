<?php

namespace App\Http\Controllers\Mandev\Managers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Managers\managersModel;
use App\Http\Controllers\Mandev\Managers\source\sourceController as Source;
use DB;
use Validation;
use Notification;
use Input;

class managersController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='managers';
        public $model;
        public $validation;
        public $notification;
        public $source;
        public $api;

        public function __construct (Request $request,managersModel $model,Validation $validation,Notification $notification,Source $source)
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
        //get managers list
        $this->data['query'] = $this->source->data("managers")->get("get");

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


    public function postManagersfilter()
    {
        return app("\Filter")->data(function()
        {
            return $this->getIndex();
        });
    }


    public function postProcessmanagers()
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
                            return app("\Query")->isTrue($this->model->postprocessmanagers(),function()
                            {
                                return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                            });
                        });

                    });

                });

            });

        }

    public function getNewmanagers()
        {
            //it just accepts ajax request
            return app("\Ajax")->control(function()
            {
                //content auth
                return app("\Role")->get(1,function()
                {
                    //new name
                    $this->data['name']='managers';

                    //return view
                    return view("".config("app.admin_dirname").".tsqlnew",$this->data);
                });
            });
        }

        public function postManagersnew()
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
                            return app("\Query")->isTrue($this->model->postManagersnew(),function()
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
                $this->data['name']='managers';

                //return view
                return view("".config("app.admin_dirname").".tsqledit",$this->data);
            });
        });
    }


    public function postManagers()
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
                        return app("\Query")->isTrue($this->model->postManagers(),function()
                        {
                            return $this->notification->success(['msg'=>$this->data['successdata'],'title'=>$this->data['successful']]);
                        });
                    });

                });

            });

        });

    }
}
