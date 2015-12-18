<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class testController extends Controller
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request=$request;
    }
    public function index()
    {
        if(preg_match('@local@is',gethostname()))
        {
            return 'developer';
        }
        else
        {
            return 'production';
        }
    }
}
