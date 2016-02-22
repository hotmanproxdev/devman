<?php

namespace App\Http\Controllers\Mandev\Test;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Http\Controllers\Mandev\Test\testModel;
use DB;
use Validation;
use Notification;
use Input;

class testController extends Controller
{
        public $request;
        public $app;
        public $data;
        public $admin;
        public $url_path='test';
        public $model;
        public $validation;
        public $notification;

        public function __construct (Request $request,testModel $model,Validation $validation,Notification $notification)
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

        }

    public function getChangesql ()
    {
        $changesql=explode("//",Input::get("changesql"));

        $sql=DB::table($this->app->dbTable([$changesql[0]]))->select([$changesql[2]])->where($changesql[1],"=",Input::get("val"))->get();

        $list=array('<option value="none">'.$this->data['apiGroup'].'</option>');

        if(count($sql))
        {
            foreach ($sql as $result)
            {
                $reschange=DB::table($this->app->dbTable([$changesql[3]]))->select(['id',$changesql[4]])->where($changesql[4],"=",$result->$changesql[2])->get();

                $list[]='<option value="'.$reschange[0]->id.'">'.$reschange[0]->$changesql[4].'</option>';
            }
        }

        return implode("",$list);
    }


    public function getMakeswitch()
    {
        $model=explode("/",Input::get("model"));

        if(Input::get("state")=="true")
        {
            $state=1;
        }
        else
        {
            $state=0;
        }

        DB::table($this->app->dbTable([$model[0]]))->where("id","=",$model[2])->update([$model[1]=>$state]);
    }



}
