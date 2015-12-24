<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;

class mysqlLogController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $post;
    public $admin;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
    }
    public function mysql()
    {
        return DB::getQueryLog();
    }
}
