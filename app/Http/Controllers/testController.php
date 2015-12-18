<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class testController extends Controller
{
    public function index()
    {
        dd(\App::environment());
    }
}
