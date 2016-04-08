<?php

namespace App\Http\Controllers\Mandev\Tsql\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Tsql\tsqlModel;
use DB;

class tsqlController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $admin;
    public $url_path='logs';
    public $model;
    public $logCounter;
    public $logCounterArray;
    public $tsql;
    public $tdata;

    public function __construct (Request $request,tsqlModel $model)
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

    public function getPackList()
    {
        return $this->tsql
                           /*tsql name */
                           ->name("logt")

                           /*table header name */
                           ->header("Log Table")

                           /* query is here..orm condition */
                           ->query($this->model->getLogs())

                           /* (optional) wanted fields */
                           ->fields(
                                    [
                                        'id'=>'Id',
                                        'ccode'=>'Sistem Kodu',
                                        'userid'=>'Kullanıcı',
                                        'userip'=>'İp',
                                        'isMobile'=>'Mobil',
                                        'manipulation'=>'Manipulation',
                                        'isTablet'=>'Tablet',
                                        'isDesktop'=>'Masaustu',
                                        'created_at'=>'Oluşturma Zamanı',
                                        'test'=>'Bar',
                                        'test2'=>'Foo'
                                    ],1
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
                                        'type'=>'select',
                                        'data'=>$this->app->ccode("toList"),
                                        'class'=>'',
                                        'default'=>['none'=>'--Sistem Kodu--'],
                                        'name'=>'ccode'
                                    ],

                                   [
                                       'type'=>'text',
                                       'data'=>[],
                                       'class'=>'',
                                       'default'=>'Kullanici adi',
                                       'name'=>'username'
                                   ],

                                   [
                                       'type'=>'button',
                                       'data'=>[],
                                       'class'=>'',
                                       'default'=>'Filtrele',
                                       'name'=>'test'
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

                               //last run
                               return $this->tsql->run(false,['data'=>$this->tdata]);
                           });
    }


}
