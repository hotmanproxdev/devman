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
        return 'hello world';
    }
}
