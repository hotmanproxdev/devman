<?php

namespace App\Http\Controllers\Mandev\Notifications\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Notifications\notificationsModel;
use DB;

class notificationsController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='notifications';
    public $model;
    public $tsql;
    public $tdata;
    public $api;

    public function __construct (Request $request,notificationsModel $model)
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
                    ->name("notifications")

                    /*table header name */
                    ->header("Tsql Header")

                    /* query is here..orm condition */
                    ->query($this->model->get())

                    /* (optional) wanted fields */
                    ->fields(
                        [
                            //'id'=>    'id',

                        ],['id'=>['before'=>['sign'=>'Sign','edit'=>'Process']]],
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
                                    'ccode'=>[1=>'Developer',2=>'Guest',0=>'No Ccode'],
                                     'status'=>[1=>$this->data['active'],0=>$this->data['passive']]
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
                                    'edit'=>['action'=>'notifications/edit','title'=>'Tsql Editleme Bölümü']
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
                                'status'=>false,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>'Service Name...',
                                'name'=>'serviceName'
                            ],

                            [
                                'type'=>'select',
                                'status'=>false,
                                'data'=>$this->app->ccode("toList"),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Sistem Kodu'],
                                'name'=>'system_ccode'
                            ],

                            [
                                'type'=>'select',
                                'status'=>false,
                                'data'=>['1'=>'Developer','2'=>'Guest'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Erişim Statüsü'],
                                'name'=>'ccode'
                            ],

                            [
                                'type'=>'text',
                                'status'=>false,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>'Apikey...',
                                'name'=>'apikey'
                            ],

                            [
                                'type'=>'text',
                                'status'=>false,
                                'data'=>'',
                                'class'=>'datetimepicker',
                                'append'=>'',
                                'default'=>'Oluşturma Zamanı...',
                                'name'=>'created_at'
                            ],

                            [
                                'type'=>'button',
                                'status'=>false,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>'Filtrele',
                                'action'=>'Notifications/Notificationsfilter'
                            ],

                            [
                                'type'=>'action',
                                'status'=>true,
                                'data'=>['1'=>'Seçilileri Sil'],
                                'class'=>'',
                                'default'=>'--Seçililere İşlem Uygula--',
                                'action'=>'processnotifications'
                            ]
                        ]

                    )


                     ->edit(

                                            [
                                                'action'=>'notifications',

                                                'out'=>[
                                                    'created_at',
                                                    'updated_at'
                                                ],

                                                'in'=> [

                                                    //'ccode'
                                                ],


                                                'in'=>[

                                                    //'ccode'
                                                ],

                                                'select'=>[

                                                    //'status'=>[1=>$this->data['active'],0=>$this->data['passive']]
                                                ],

                                                'header'=>[

                                                   //'role_define'=>'Rol Tanımı'
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
