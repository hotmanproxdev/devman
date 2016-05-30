<?php

namespace App\Http\Controllers\Mandev\Menus\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Menus\menusModel;
use DB;

class menusController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='menus';
    public $model;
    public $tsql;
    public $tdata;
    public $api;

    public function __construct (Request $request,menusModel $model)
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
                    ->name("menus")

                    /*table header name */
                    ->header($this->data['menulist'])

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
                                     'status'=>[1=>$this->data['active'],0=>$this->data['passive']],
                                    'parent'=>[0=>$this->data['mainMenu']]+$this->model->getMainMenus()
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
                                    'edit'=>['action'=>'menus/editmenus','title'=>'Tsql Editleme Bölümü']
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
                                'default'=>'Menu İsmi',
                                'name'=>'menu'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>[0=>$this->data['mainMenu']]+$this->model->getMainMenus(),
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Menü Tipi'],
                                'name'=>'parent'
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
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>'Link',
                                'name'=>'link'
                            ],

                            [
                                'type'=>'select',
                                'status'=>true,
                                'data'=>['1'=>'Aktif','0'=>'Pasif'],
                                'class'=>'',
                                'append'=>'',
                                'default'=>['none'=>'Durum'],
                                'name'=>'status'
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
                                'status'=>true,
                                'data'=>'',
                                'class'=>'',
                                'append'=>'',
                                'default'=>$this->data['filter'],
                                'action'=>'menus/menusfilter'
                            ],

                            [
                                'type'=>'action',
                                'status'=>true,
                                'data'=>['1'=>$this->data['delete_selected']],
                                'class'=>'',
                                'default'=>'--;'.$this->data['app_delete_selected'].'--',
                                'action'=>'processmenus'
                            ]
                        ]

                    )->filterDivide(7)


                     ->edit(

                                            [
                                                'action'=>'menus',

                                                'out'=>[
                                                    'created_at',
                                                    'updated_at'
                                                ],

                                                'in'=> [

                                                    //'ccode'
                                                ],

                                                'select'=>[

                                                    //'status'=>[1=>$this->data['active'],0=>$this->data['passive']]
                                                ],

                                                'header'=>[

                                                   'menu'=>'Menu İsmi',
                                                    'icon'=>'Menu Resmi',
                                                    'parent'=>'Alt Menu Seçimi',
                                                    'link'=>'Menu Linki',
                                                    'row'=>'Menu Sıralaması',
                                                    'status'=>'Menü Durumu'
                                                ],


                                                'require'=>[

                                                    'menu',
                                                    'icon',
                                                    'parent',
                                                    'row'
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

                            //update list
                            $this->tdata=$this->tsql->update(['list'=>$list,'data'=>$data]);

                        });


                        //run
                        return $this->tsql->run(false,['data'=>$this->tdata]);
                    });
    }



}
