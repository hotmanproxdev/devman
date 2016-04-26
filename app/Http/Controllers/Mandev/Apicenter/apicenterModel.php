<?php

namespace App\Http\Controllers\Mandev\Apicenter;

use App\Http\Controllers\Mandev\Tsql\tsqlModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class apicenterModel extends Controller
{
    public $request;
    public $app;
    public $admin;

    public function __construct (Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page role
        $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);

    }

    public function getApiUsers()
    {
        //default filter query
        return DB::table($this->app->dbTable(['api']))
               ->where(
                       function ($query)
                       {
                            if($this->admin->system_number>0)
                            {
                                $query->where("system_ccode","=",$this->admin->ccode);
                            }

                            if($this->request->ajax())
                            {
                                foreach (app("\Filter")->getData($this->filterHas()) as $key=>$value)
                                {
                                    if($key=="apikey")
                                    {
                                        $query->where(''.$this->app->dbTable(['api']).'.'.$key.'',"like",'%'.$value.'%');
                                    }
                                    else
                                    {
                                        $query->where(''.$this->app->dbTable(['api']).'.'.$key.'',"=",$value);
                                    }

                                }
                            }
                            else
                            {
                                app("\Filter")->forget();
                            }
                       }
                       )
                       ->orderBy("id","desc")
                       ->paginate(5);
    }


    public function getApiLogs()
    {
        //default filter query
        return DB::table($this->app->dbTable(['log_api']))->
        select(''.$this->app->dbTable(['log_api']).'.*',''.$this->app->dbTable(['api']).'.apikey')
            ->leftJoin($this->app->dbTable(['api']),''.$this->app->dbTable(['log_api']).'.apikey','=',''.$this->app->dbTable(['api']).'.id')
               ->where(
                       function ($query)
                       {
                           if($this->admin->system_number>0)
                           {
                               $query->where("".$this->app->dbTable(['log_api']).".system_ccode","=",$this->app->ccode($this->admin->ccode));
                           }

                            if($this->request->ajax() && !array_key_exists("ajax",\Input::all()))
                            {
                                foreach (app("\Filter")->getData($this->filterHas()) as $key=>$value)
                                {
                                    if($key=="apikey")
                                    {
                                        $query->where(''.$this->app->dbTable(['api']).'.'.$key.'',"=",$value);
                                    }
                                    elseif($key=="created_at")
                                    {
                                        $tablekey=''.$this->app->dbTable(['log_api']).'.'.$key.'';
                                        $query->whereRaw("FROM_UNIXTIME(".$tablekey.",'%Y-%m-%d') ='".date("Y-m-d",strtotime($value))."'");
                                    }
                                    else
                                    {
                                        $query->where(''.$this->app->dbTable(['log_api']).'.'.$key.'',"=",$value);
                                    }

                                }
                            }
                            else
                            {
                                app("\Filter")->forget();
                            }
                       }
                       )
                       ->orderBy("id","desc")
                       ->paginate(10);
    }



    public function getUserApi()
    {
        //get query users api
        $query=DB::table($this->app->dbTable(['api']))->where("id","=",\Input::get("id"))->get();

        //query count is true
        return app("\Query")->isCountTrue($query,function() use ($query)
        {
            //user just can edit own group (except system_code 0)
            return app("\DevSource")->ccode($query[0]->system_ccode,function() use ($query)
            {
                //true
                return $query;
            });
        });


    }




    public function updateUserApi()
    {
        return app("\Transaction")->commit(function()
        {
            //post id control for manipulation
            if(!is_array($this->getUserApi(\Input::get("id"))))
            {
                return false;
            }

            //reel key post data
            $postdata=$this->app->getvalidPostKey(\Input::all(),['_token','id']);

            //access services implode string key converter
            if(array_key_exists("access_services",\Input::all()))
            {
                $postdata['access_services']=implode("-",$postdata['access_services']);
            }
            else
            {
                $postdata['access_services']=NULL;
            }


            //ccode = guest / add dbtable
            if(\Input::get("ccode")=="guest")
            {
                foreach ($this->app->dbTable(['all']) as $db=>$dbt)
                {
                    if(array_key_exists("forbidden_access_services",$postdata))
                    {
                        if(!in_array($db,$postdata['forbidden_access_services']))
                        {
                            $postdata['forbidden_access_services'][]=$db;
                        }
                    }
                    else
                    {
                        $postdata['forbidden_access_services'][]=$db;
                    }


                }
            }

            //forbidden access services implode string key converter
            if(array_key_exists("forbidden_access_services",\Input::all()))
            {
                if(\Input::get("ccode")=="develop")
                {
                    $postdata['forbidden_access_services']=NULL;
                }
                else
                {
                    $postdata['forbidden_access_services'] = implode("-", $postdata['forbidden_access_services']);
                }
            }
            else
            {
                if($this->getUserApi(\Input::get("id"))[0]->ccode=="develop" && \Input::get("ccode")=="develop")
                {
                    $postdata['forbidden_access_services']=NULL;
                }
                else
                {
                    $postdata['forbidden_access_services']=implode("-",$postdata['forbidden_access_services']);
                }

            }

            //set log for data changed
            return app("\Query")->upLog(['api',\Input::get("id"),$postdata],function() use ($postdata)
            {
                //query booelean true
                return DB::table($this->app->dbTable(['api']))->where("id","=",\Input::get("id"))->update($postdata);
            });

        });
    }



    public function insertNewUserApi()
    {
        return app("\Transaction")->commit(function()
        {
            //reel key post data
            $postdata=$this->app->getvalidPostKey(\Input::all(),['_token']);

            //access services implode string key converter
            if(array_key_exists("access_services",\Input::all()))
            {
                $postdata['access_services']=implode("-",$postdata['access_services']);
            }
            else
            {
                $postdata['access_services']=NULL;
            }


            //ccode = guest / add dbtable
            if(\Input::get("ccode")=="guest")
            {
                foreach ($this->app->dbTable(['all']) as $db=>$dbt)
                {
                    if(array_key_exists("forbidden_access_services",$postdata))
                    {
                        if(!in_array($db,$postdata['forbidden_access_services']))
                        {
                            $postdata['forbidden_access_services'][]=$db;
                        }
                    }
                    else
                    {
                        $postdata['forbidden_access_services'][]=$db;
                    }


                }
            }


            //forbidden access services implode string key converter
            if(array_key_exists("forbidden_access_services",\Input::all()))
            {
                if(\Input::get("ccode")=="develop")
                {
                    $postdata['forbidden_access_services']=NULL;
                }
                else
                {
                    $postdata['forbidden_access_services'] = implode("-", $postdata['forbidden_access_services']);
                }
            }
            else
            {
                if(\Input::get("ccode")=="develop")
                {
                    $postdata['forbidden_access_services']=NULL;
                }
                else
                {
                    $postdata['forbidden_access_services']=implode("-",$postdata['forbidden_access_services']);
                }

            }


            //created at
            $postdata['created_at']=time();


            if($this->admin->system_number==0)
            {
                $postdata['system_ccode']=\Input::get("system_ccode");
            }
            else
            {
                $postdata['system_ccode']=$this->admin->ccode;
            }

            //query insert get id
            $id=DB::table($this->app->dbTable(['api']))->insertGetId($postdata);

            return app("\Query")->isTrue($id,function() use ($id)
            {
                //standart key update
                return DB::table($this->app->dbTable(['api']))->where("id","=",$id)->update(['standart_key'=>$this->app->getApiStandartKey($id)]);
            });

        });
    }



    private function filterHas()
    {
        return app("\Filter")->filterHas();
    }




}
