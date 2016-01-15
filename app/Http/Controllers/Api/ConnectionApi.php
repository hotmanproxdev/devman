<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;

class connectionApi extends Controller
{

    public function getIndex ()
    {
        //return view

        return response()->json(['test'=>true]);
    }
}
