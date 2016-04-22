<?php

namespace App\Http\Controllers\Mandev\Apicenter\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Apicenter\apicenterModel;
use DB;

class apiLogsController extends Controller
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
            ->name("apilogs")

            /*table header name */
            ->header("Api Logları Bölümü")

            /* query is here..orm condition */
            ->query($this->model->getApiLogs())

            /* (optional) wanted fields */
            ->fields(
                [
                    //'id'=>    'id',

                ],['system_ccode'=>['before'=>['serviceName'=>'ServiceName','msg'=>'Msg','postdata'=>'Postdata']]],
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
                            'system_ccode'=>$this->app->ccode("toList"),
                            'ccode'=>[1=>'Developer',2=>'Guest',0=>'No Ccode']
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
                            //'edit'=>['action'=>'apicenter/edit','title'=>'Api Kullanıcısı Editleme Bölümü']
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
                        'default'=>'Service Name...',
                        'name'=>'serviceName'
                    ],

                    [
                        'type'=>'select',
                        'status'=>($this->admin->system_number==0) ? true : false,
                        'data'=>$this->app->ccode("toList"),
                        'class'=>'',
                        'append'=>'',
                        'default'=>['none'=>'Sistem Kodu'],
                        'name'=>'system_ccode'
                    ],

                    [
                        'type'=>'select',
                        'status'=>($this->admin->system_number==0) ? true : false,
                        'data'=>['1'=>'Developer','2'=>'Guest'],
                        'class'=>'',
                        'append'=>'',
                        'default'=>['none'=>'Erişim Statüsü'],
                        'name'=>'ccode'
                    ],

                    [
                        'type'=>'text',
                        'status'=>true,
                        'data'=>'',
                        'class'=>'',
                        'append'=>'',
                        'default'=>'Apikey...',
                        'name'=>'apikey'
                    ],

                    [
                        'type'=>'button',
                        'status'=>true,
                        'data'=>'',
                        'class'=>'',
                        'append'=>'',
                        'default'=>'Filtrele',
                        'action'=>'apicenter/apilogsfilter'
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
                    //update list
                    $this->tdata=$this->tsql->update(['list'=>$list,'data'=>$data]);

                });


                //run
                return $this->tsql->run(false,['data'=>$this->tdata]);
            });
    }
}
