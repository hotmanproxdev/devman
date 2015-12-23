<?php

namespace App\Http\Controllers\Mandev;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class logoutController extends Controller
{
    public function index()
    {
        Session::forget('userHash');
        return redirect("".strtolower(config("app.admin_dirname"))."/login");
    }
}
