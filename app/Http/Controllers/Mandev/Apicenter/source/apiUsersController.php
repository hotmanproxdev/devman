<?php

namespace App\Http\Controllers\Mandev\Apicenter\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Apicenter\apicenterModel;
use DB;

class apiUsersController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='apicenter';
    public $model;
    public $tsql;
    public $tdata;

    public function __construct (Request $request,apicenterModel $model)
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


    }


    public function getList()
    {
        return $this->tsql
                            /*tsql name */
                            ->name("apiusers")

                            /*table header name */
                            ->header("Api Kullanıcıları Bölümü")

                            /* query is here..orm condition */
                            ->query($this->model->getApiUsers())

                            /* (optional) wanted fields */
                            ->fields(
                                        [
                                            //'id'=>    'id',

                                        ],  [
                                                    'system_ccode'=>['before'=>['edit'=>'İşlem']],
                                                    'apikey'=>['after'=>['standart_key'=>'Standart_key']],
                                                    'except'=>['statu']
                                            ],
                                          ['auth'=>[
                                                    'hash'=>function()
                                                    {
                                                        if($this->admin->system_number==0)
                                                        {
                                                            return true;
                                                        }
                                                    },
                                                      'hash_number'=>function()
                                                      {
                                                          if($this->admin->system_number==0)
                                                          {
                                                              return true;
                                                          }
                                                      },
                                                      'hash_limit'=>function()
                                                      {
                                                          if($this->admin->system_number==0)
                                                          {
                                                              return true;
                                                          }
                                                      },
                                                      'api_coding_insert'=>function()
                                                      {
                                                          if($this->admin->system_number==0)
                                                          {
                                                              return true;
                                                          }
                                                      },
                                                      'api_coding_update'=>function()
                                                      {
                                                          if($this->admin->system_number==0)
                                                          {
                                                              return true;
                                                          }
                                                      },
                                                      'api_coding_delete'=>function()
                                                      {
                                                          if($this->admin->system_number==0)
                                                          {
                                                              return true;
                                                          }
                                                      },
                                                      'api_develop_url_filter'=>function()
                                                      {
                                                          if($this->admin->system_number==0)
                                                          {
                                                              return true;
                                                          }
                                                      }
                                          ]]
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
                                                   'access_service_key'=>
                                                       [
                                                           "1"=>$this->data['open'],
                                                           "0"=>$this->data['close'],
                                                       ],

                                                   'api_coding_insert'=>
                                                       [
                                                           "1"=>$this->data['open'],
                                                           "0"=>$this->data['close'],
                                                       ],

                                                   'api_coding_update'=>
                                                       [
                                                           "1"=>$this->data['open'],
                                                           "0"=>$this->data['close'],
                                                       ],

                                                   'api_coding_delete'=>
                                                       [
                                                           "1"=>$this->data['open'],
                                                           "0"=>$this->data['close'],
                                                       ],

                                                   'api_develop_url_filter'=>
                                                       [
                                                           "1"=>$this->data['open'],
                                                           "0"=>$this->data['close'],
                                                       ],

                                                   'request_type'=>
                                                       [
                                                           "1"=>$this->data['open'],
                                                           "0"=>$this->data['close'],
                                                       ]

                                                   //'field'=>'query:table:matchfield'
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
                                                            'edit'=>['action'=>'apicenter/edit','title'=>'Api Kullanıcısı Editleme Bölümü']
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
                                                    'id'=>'xtext2',
                                                    'statu'=>'statu',
                                                    'apikey'=>'namecolor',
                                                    'standart_key'=>'key',
                                                    'system_ccode'=>'ccode'
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
                                               'type'=>'select',
                                               'status'=>($this->admin->system_number==0) ? true : false ,
                                               'data'=>$this->app->ccode("smooth"),
                                               'class'=>'system_ccode',
                                               'append'=>'',
                                               'default'=>['none'=>'--Sistem Kodu--'],
                                               'name'=>'system_ccode'
                                           ],

                                           [
                                               'type'=>'select',
                                               'status'=>($this->admin->system_number==0) ? true : false ,
                                               'data'=>['guest'=>'Misafir','develop'=>'Geliştirici'],
                                               'class'=>'ccode',
                                               'append'=>'',
                                               'default'=>['none'=>'--Sistem Kodu--'],
                                               'name'=>'ccode'
                                           ],

                                           [
                                               'type'=>'text',
                                               'status'=>true,
                                               'data'=>'',
                                               'class'=>'api_key',
                                               'append'=>'',
                                               'default'=>'Apikey...',
                                               'name'=>'apikey'
                                           ],


                                           [
                                               'type'=>'select',
                                               'status'=>true,
                                               'data'=>['1'=>'Açık','0'=>'Kapalı'],
                                               'class'=>'access_service_key',
                                               'append'=>'',
                                               'default'=>['none'=>'--Servis Durumu--'],
                                               'name'=>'access_service_key'
                                           ],

                                           [
                                               'type'=>'button',
                                               'status'=>true,
                                               'data'=>'',
                                               'class'=>'',
                                               'append'=>'',
                                               'default'=>'Filtrele',
                                               'name'=>'apiusers'
                                           ],

                                           [
                                               'type'=>'action',
                                               'status'=>false,
                                               'data'=>['1'=>'Seçilileri Sil'],
                                               'class'=>'',
                                               'default'=>'--Seçililere İşlem Uygula--',
                                               'action'=>'tsqlprocess'
                                           ]
                                       ]

                                   )

                                   /* command run */
                                   ->run(function($data)
                                   {
                                        //callback list
                                        $this->tsql->update([],function($list) use ($data)
                                        {
                                            //created field
                                            $list['created_at']=['query'=>function($query)
                                            {
                                                if(count($query))
                                                {
                                                    foreach ($query as $result)
                                                    {
                                                        $list[]=date("Y-m-d H:i:s");
                                                    }
                                                    return $list;
                                                }
                                            }];
                                             //update list
                                             $this->tdata=$this->tsql->update(['list'=>$list,'data'=>$data]);

                                        });


                                        //run
                                        return $this->tsql->run(false,['data'=>$this->tdata]);
                                   });
    }
}
