<?php

namespace App\Http\Controllers\Mandev\Managers\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Managers\managersModel;
use DB;

class managersController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='managers';
    public $model;
    public $tsql;
    public $tdata;
    public $api;

    public function __construct (Request $request,managersModel $model)
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
        //admin view
        $this->data['admin']=$this->admin;
        //get model
        $this->model=$model;
        //app tsql
        $this->tsql=app("\Tsql");
        //get api services
        $this->api=app("Api")->version(config("app.apiversion"));


    }

    public function get()
    {
        return $this->tsql
                    /*tsql name */
                    ->name("managers")

                    /*table header name */
                    ->header("Tsql Header")

                    /* query is here..orm condition */
                    ->query($this->model->get())

                    /* (optional) wanted fields */
                    ->fields(
                        [
                            //'id'=>    'id',

                        ],[
                           'username'=>
                                ['after'=>['fullname'=>'Fullname']],
                           'except'=>
                                ['password','role','last_token','last_post','hash','last_hash','first_hash_time']],
                        ['auth'=>[]]
                    )

                    /* (optional) field css */
                    ->fieldCss(
                        [
                            'all'=>'xtext'
                        ]
                    )

                    /* (optional) wanted fields */
                    ->contentIn(
                        [
                            'matching'=>
                                [
                                    'ccode'=>($this->admin->system_number==0) ? $this->app->ccode("toList") : [$this->admin->ccode=>$this->admin->ccode],
                                     'status'=>[1=>$this->data['active'],0=>$this->data['passive']],
                                    'created_by'=>'admin:id:username'
                                ],
                            'input'=>
                                [
                                    'sign'=>'checkbox'
                                ],

                            'icon'=>
                                [
                                    'edit'=>'edit.png'
                                ],

                            'modal'=>
                                [
                                    'edit'=>['action'=>'managers/edit','title'=>'Tsql Editleme Bölümü']
                                ],

                            'link'=>
                                [
                                    'username'=>'profile/:id'
                                ],

                            'hidden'=>
                                [
                                    //'test'=>'1'
                                ]

                        ]
                    )

                    /* (optional) content css */
                    ->contentCss(
                        [
                            'id'=>'xtext2'
                        ]
                    )


                    /* (optional) pagination */
                    ->pagination(
                        [
                            'status'=>true,
                            'header'=>'Sayfalar',
                            'limitview'=>5,
                            'type'=>'ajax'
                        ]
                    )



                    /* (optional) filter */
                    ->filter(
                        [
                            [
                                'type'=>'text',
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>$this->data['username'],
                                'name'=>'username'
                            ],

                            [
                                'type'=>'select',
                                'status'=>($this->admin->system_number>0) ? false : true,
                                'data'=>$this->app->ccode("toList"),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Sistem Kodu'],
                                'name'=>'ccode'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>$this->data['active'],'0'=>$this->data['passive']],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>$this->data['status']],
                                'name'=>'status'
                            ],

                            [
                                'type'=>'text',
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>$this->data['email'],
                                'name'=>'email'
                            ],

                            [
                                'type'=>'text',
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>'Ip',
                                'name'=>'last_ip'
                            ],

                            [
                                'type'=>'button',
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>$this->data['filter'],
                                'action'=>'managers/managersfilter'
                            ],

                            [
                                'type'=>'action',
                                'status'=>false,
                                'data'=>['1'=>$this->data['delete_selected']],
                                'class'=>'',
                                'default'=>'--;'.$this->data['app_delete_selected'].'--',
                                'action'=>'processmanagers'
                            ]
                        ]

                    )->filterDivide(7)


                     ->edit(

                                            [
                                                'action'=>'managers',

                                                'out'=>[
                                                    'created_at',
                                                    'updated_at',
                                                    'hash',
                                                    'last_hash'
                                                ],

                                                'in'=> [

                                                    'ccode',
                                                    'username',
                                                    'password',
                                                    'email',
                                                    'fullname'
                                                ],

                                                'select'=>[

                                                    //'status'=>[1=>$this->data['active'],0=>$this->data['passive']]
                                                ],

                                                'header'=>[

                                                   'password'=>'Yeni Şifre'
                                                ],

                                                'require'=>[

                                                    'username',
                                                    'password',
                                                    'email',
                                                    'fullname'
                                                ]
                                            ]
                                        )

                    /* command run */
                    ->run(function($data)
                    {
                        //callback list
                        $this->tsql->update([],function($list) use ($data)
                        {

                            $list['created_at']=['query'=>function ($query)
                            {
                                $list=[];
                               if(count($query))
                               {
                                   foreach ($query as $result)
                                   {
                                       $list[]=date("Y-m-d H:i:s",$result->created_at);
                                   }
                               }

                                return $list;
                            }];


                            $list['updated_at']=['query'=>function ($query)
                            {
                                $list=[];
                                if(count($query))
                                {
                                    foreach ($query as $result)
                                    {
                                        $list[]=date("Y-m-d H:i:s",$result->updated_at);
                                    }
                                }

                                return $list;
                            }];


                            $list['last_login_time']=['query'=>function ($query)
                            {
                                $list=[];
                                if(count($query))
                                {
                                    foreach ($query as $result)
                                    {
                                        $list[]=date("Y-m-d H:i:s",$result->last_login_time);
                                    }
                                }

                                return $list;
                            }];


                            $list['logout_time']=['query'=>function ($query)
                            {
                                $list=[];
                                if(count($query))
                                {
                                    foreach ($query as $result)
                                    {
                                        if($result->logout_time==0)
                                        {
                                            $list[]='No Login';
                                        }
                                        else
                                        {
                                            $list[]=date("Y-m-d H:i:s",$result->logout_time);
                                        }

                                    }
                                }

                                return $list;
                            }];

                            //update list
                            $this->tdata=$this->tsql->update(['list'=>$list,'data'=>$data]);

                        });


                        //run
                        return $this->tsql->run(false,['data'=>$this->tdata]);
                    });
    }
}
