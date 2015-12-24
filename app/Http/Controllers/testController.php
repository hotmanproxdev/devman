<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class testController extends Controller
{
    public $request;
    public $app;

    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->app=app()->make("Base");
    }

    public function index()
    {
        return $this->foo(2,2);
    }

    public function foo($a,$b)
    {
        $result=$a+$b;
        return ['result'=>$result];
    }

}
