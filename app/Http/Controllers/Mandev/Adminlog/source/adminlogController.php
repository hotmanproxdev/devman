<?php

namespace App\Http\Controllers\Mandev\Adminlog\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Adminlog\adminlogModel;
use DB;

class adminlogController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='adminlog';
    public $model;
    public $tsql;
    public $tdata;
    public $api;

    public function __construct (Request $request,adminlogModel $model)
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
                    ->name("adminlog")

                    /*table header name */
                    ->header($this->data['logtable'])

                    /* query is here..orm condition */
                    ->query($this->model->get())

                    /* (optional) wanted fields */
                    ->fields(
                        [
                            //'id'=>    'id',

                        ],['id'=>['after'=>['created_at'=>'created_at','passing'=>'PassingTime']],'except'=>['user_agent','userip']],
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
                                    'ccode'=>$this->app->ccode("toList"),
                                    'userid'=>'query:admin:username'
                                ],
                            'input'=>
                                [
                                    //'sign'=>'checkbox'
                                ],

                            'icon'=>
                                [
                                    //'edit'=>'edit.png'
                                ],

                            'modal'=>
                                [
                                    'edit'=>['action'=>'adminlog/edit','title'=>'Tsql Editleme Bölümü']
                                ],

                            'link'=>
                                [
                                    //'ccode'=>'blabla'
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
                                'default'=>''.$this->data['adminname'].'...',
                                'name'=>'username'
                            ],

                            [
                                'type'=>'select',
                                'status'=>($this->admin->system_number==0) ? true : false,
                                'data'=>$this->app->ccode("toList"),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>$this->data['ccode']],
                                'name'=>'ccode'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>'Mobil','0'=>'No Mobil'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Mobil Status'],
                                'name'=>'isMobile'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>'Tablet','0'=>'No Tablet'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Tablet Status'],
                                'name'=>'isTablet'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>'Desktop','0'=>'No Desktop'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Desktop Status'],
                                'name'=>'isDesktop'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>'Bot','0'=>'No Bot'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Bot Status'],
                                'name'=>'isBot'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>$this->model->getBrowserFamily(),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Browser Family'],
                                'name'=>'browserFamily'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>$this->model->getosFamily(),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Os Family'],
                                'name'=>'osFamily'
                            ],


                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>$this->model->getdeviceFamily(),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Device Family'],
                                'name'=>'deviceFamily'
                            ],


                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>$this->data['valid'],'0'=>$this->data['invalid']],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Url Valid Statu'],
                                'name'=>'url_path_valid'
                            ],


                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>'Get','2'=>'Post'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Log Process'],
                                'name'=>'log_process'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['0'=>$this->data['noexist'],'1'=>$this->data['exist']],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Fail Operations'],
                                'name'=>'fail_operations'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['0'=>$this->data['noexist'],'1'=>$this->data['exist']],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Manipulation'],
                                'name'=>'manipulation'
                            ],


                            [
                                'type'=>'button',
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>$this->data['filter'],
                                'action'=>'adminlog/adminlogfilter'
                            ],

                            [
                                'type'=>'action',
                                'status'=>false,
                                'data'=>['1'=>$this->data['delete_selected']],
                                'class'=>'',
                                'default'=>'--;'.$this->data['app_delete_selected'].'--',
                                'action'=>'processadminlog'
                            ]
                        ]

                    )->filterDivide(7)

                    ->graph(
                        [
                            'status'=>true,
                            'datas'=>
                            [

                            ]
                        ]
                    )


                    /* command run */
                    ->run(function($data)
                    {
                        //callback list
                        $this->tsql->update([],function($list) use ($data)
                        {
                            $list['created_at']=['query'=>function($query)
                            {
                                foreach ($query as $result)
                                {
                                    $list[]=date("Y-m-d H:i:s",$result->created_at);
                                }

                                return $list;
                            }];

                            $list['passing']=['query'=>function($query)
                            {
                                foreach ($query as $result)
                                {
                                    $list[]=app("\Time")->getPassing(strtotime($result->created_at))->output;
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
