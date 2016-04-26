<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EnvironmentController extends Controller
{

    public $request;
    public $app;
    public $paths=array("Api"=>'App\Http\Controllers\Api\Custom');
    public $data=array();
    public $method;

    public function __construct(Request $request)
    {
        //request method
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
    }

    public function system($system=array())
    {
        if(count($system))
        {
            $this->data=array_merge($this->data,$system);
            return $this;
        }
    }

    public function get($method)
    {
        $this->method=$method;
        return $this;
    }

    public function run ($arg=array())
    {
        if($this->data[1]=="Api")
        {
            $originalclass=explode("\\",$this->data[0]);
            $class=explode("\\",$this->data[0]);
            unset($class[key( array_slice( $class, -1, 1, TRUE ) )]);

            $source='\\'.implode("\\",$class).'\\Source\\'.end($originalclass).'Source';

            if($this->method==NULL)
            {
                return app($source)->get($arg);
            }
            else
            {
                $method=$this->method;
                return app($source)->$method($arg);
            }

        }

    }
}
