<?php

namespace App\Http\Controllers\Mandev\Tsql\source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;

class sourceController extends Controller
{

    public $sourcedata=array("class"=>__NAMESPACE__);

    public function __construct (Request $request)
    {
        //page protector
        $this->middleware('auth');
    }

    public function data ($data=false)
    {
       if($data)
       {
           $this->sourcedata['data']=$data;
       }

        return $this;
    }

    public function get($data=false,$param=false)
    {
        if($data)
        {
            $this->sourcedata['method']=$data;
        }

        $callNameSpace='\\'.$this->sourcedata['class'].'\\'.$this->sourcedata['data'].'Controller';
        $method=$this->sourcedata['method'];

        if($param)
        {
            return app($callNameSpace)->$method($param);
        }
        return app($callNameSpace)->$method();
    }


}
