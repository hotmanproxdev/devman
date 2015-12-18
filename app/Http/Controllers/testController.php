<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class testController extends Controller
{
    public $request;
    public $app;

    public function index()
    {
        return $this->app->test();
    }
    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->app=app()->make("Base");
    }
}
