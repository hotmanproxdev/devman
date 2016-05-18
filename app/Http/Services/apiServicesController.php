<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class apiServicesController extends Controller
{

    public $request;
    public $app;
    public $data;
    public $version;
    public $serviceName;
    public $model=false;
    public $source=false;
    public $select=false;
    public $where=false;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request method
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function version($version=false)
    {
        if($version)
        {
            $this->version=$version;
            return $this;
        }
    }

    public function service($serviceName=false)
    {
        if($serviceName)
        {
            $this->serviceName=$serviceName;
            return $this;
        }
    }


    public function model($model=false)
    {
        if(!$model)
        {
            $this->model=''.ucfirst($this->serviceName).'ApiModel';
            return $this;
        }
    }


    public function source($source=false)
    {
        if(!$source)
        {
            $this->source=''.ucfirst($this->serviceName).'ApiSource';
            return $this;
        }
    }

    public function select($data=array())
    {
        if($this->model)
        {
            $this->select=$data;
        }

        return $this;
    }

    public function where($data=array())
    {
        if($this->model)
        {
            $this->where=$data;
        }

        return $this;
    }

    public function get($get=false,$arg=false)
    {

        if(!$this->model)
        {
            $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\\'.ucfirst($this->serviceName).'Api';

            if($this->source)
            {
                $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\Source\\'.ucfirst($this->serviceName).'ApiSource';
            }
        }
        else
        {
            $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\Model\\'.$this->model.'';
        }


        if(!$get)
        {
            if($this->where or $this->select)
            {
                return app($path)->get(['headers'=>['where'=>$this->where,'select'=>$this->select]]);
            }

            return app($path)->get($arg);

        }

        return app($path)->$get($arg);
    }


    public function update($arg=false,$get=false)
    {


        $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\Model\\'.$this->model.'';


        if(!$get)
        {
            return app($path)->update(['headers'=>['select'=>$this->select,'where'=>$this->where,'update'=>$arg]]);
        }

        return app($path)->$get(['headers'=>['select'=>$this->select,'where'=>$this->where,'update'=>$arg]]);
    }


    public function insert($arg=false,$get=false)
    {


        $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\Model\\'.$this->model.'';


        if(!$get)
        {
            return app($path)->insert(['headers'=>['select'=>$this->select,'where'=>$this->where,'insert'=>$arg]]);
        }

        return app($path)->$get(['headers'=>['select'=>$this->select,'where'=>$this->where,'insert'=>$arg]]);
    }


    public function delete($arg=false,$get=false)
    {


        $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\Model\\'.$this->model.'';


        if(!$get)
        {
            return app($path)->delete(['headers'=>['select'=>$this->select,'where'=>$this->where]]);
        }

        return app($path)->$get(['headers'=>['select'=>$this->select,'where'=>$this->where]]);
    }


    public function handle($get=false,$data=false)
    {

        $path='\App\Http\Controllers\Api\Custom\\'.$this->version.'\\'.$this->serviceName.'\\HandleServer';


        if(!$get)
        {
            return app($path)->get($data);
        }

        return app($path)->$get($data);
    }
}
