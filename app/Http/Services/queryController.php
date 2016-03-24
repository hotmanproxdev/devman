<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Notification;

class queryController extends Controller
{

    public $request;
    public $notification;
    public $app;
    public $data;

    public function __construct(Request $request,Notification $notification)
    {
        //page protector
        $this->middleware('auth');
        //request method
        $this->request=$request;
        //notification method
        $this->notification=$notification;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function isCountTrue($data=array(),$callback)
    {
        $val=false;

        if(count($data))
        {
            $val=true;
        }

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }


        //redirect to logout
        $this->notification->manipulation(['msg'=>$this->data['manipulation'],'title'=>$this->data['error']]);

        //redirect to logout
        dd($this->data['manipulation']);


    }

    public function isTrue($data,$callback)
    {
        $val=false;

        if($data)
        {
            $val=true;
        }


        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        //redirect to logout
        return $this->notification->warning(['msg'=>$this->data['warning_info'],'title'=>$this->data['error']]);

    }


    public function upLog($data=array(),$callback)
    {
        $val=false;

        $query=\DB::table($this->app->dbTable([$data[0]]))->where("id","=",$data[1])->get();

        if(count($query))
        {
            $changedList=[];
            $queryData=[];
            foreach ($query[0] as $key=>$value)
            {
                if(array_key_exists($key,$data[2]))
                {
                    $queryData[$key]=$value;

                    if($data[2][$key]!=$queryData[$key])
                    {
                        $changedList[$key]=['old'=>$queryData[$key],'new'=>$data[2][$key]];
                    }
                }
            }


            if(count($changedList))
            {
                \Session::forget("updateLog");

                foreach ($changedList as $ckey=>$cvalue)
                {
                    $listarr[]=['route'=>$this->request->getPathInfo(),'table'=>$data[0],'table_id'=>$data[1],
                        'field'=>$ckey,'old_value'=>$changedList[$ckey]['old'],'new_value'=>$changedList[$ckey]['new'],
                        'changed'=>json_encode($changedList),'admin'=>$this->admin->id,'ccode'=>$this->app->ccode($this->admin->ccode),'created_at'=>time()];

                    \Session::put("updateLog",$listarr);
                }



            }

            if(\Session::has("updateLog"))
            {
                $val=true;
            }
        }


        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        //redirect to logout
        return $this->notification->warning(['msg'=>$this->data['warning_info'],'title'=>$this->data['error']]);

    }
}
