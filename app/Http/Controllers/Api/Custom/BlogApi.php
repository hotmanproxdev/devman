<?php

namespace App\Http\Controllers\Api\Custom;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ApiVersionControl as Version;

class BlogApi extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $controls=['version'=>'v1','namespace'=>__NAMESPACE__];

    public function __construct (Request $request,Version $versionControl)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //version control
        $this->versionControl=$versionControl;
    }

    public function get ()
    {
        //get version
        return $this->versionControl->get($this->controls,function()
        {
            //your query
            $query=DB::table($this->table("admin"))
                ->select($this->select())
                ->where(function ($query)
                {
                    foreach ($this->where() as $key=>$value)
                    {
                        if(is_array($value))
                        {
                            $query->whereIn($key,$value);
                        }
                        else
                        {
                            $query->where($key,"=",$value);
                        }

                    }
                })
                ->get();

            //output send
            return $this->output($query);
        });

    }


    public function postUpdate()
    {
        $query=DB::table($this->table("admin"))
                        ->select($this->select())
                        ->where(function ($query)
                        {
                            foreach ($this->where() as $key=>$value)
                            {
                                $query->where($key,"=",$value);
                            }
                        })->update($this->update());

        return $this->output($query);
    }


    private function table ($table)
    {
       return $this->app->dbTable([$table]);
    }

    private function select()
    {
        if($this->request->header("select"))
        {
            return json_decode($this->request->header("select"),true);
        }

        return '*';
    }

    private function where()
    {
        if($this->request->header("where"))
        {
            return json_decode($this->request->header("where"),true);
        }

        return [];
    }


    private function update()
    {
        if($this->request->header("update"))
        {
            return json_decode($this->request->header("update"),true);
        }

        return [];
    }

    private function postdata()
    {
       return $this->app->getvalidPostKey(json_decode($this->request->header("postdata"),1),['_token']);
    }


    private function output($query)
        {
            if(count($query))
            {
                $result=['success'=>true,'query'=>$query];
            }
            else
            {
                $result=['success'=>false,'query'=>$query];
            }

            return json_encode($result);
        }

}
