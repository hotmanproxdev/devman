<?php

namespace App\Http\Controllers\Providers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseServiceProviders extends Controller
{
    public function env()
    {
        if(preg_match('@local@is',gethostname()))
        {
            return 'developer';
        }

        return 'local';
    }

    public function json($data)
    {
        return json_encode($data);
    }

    public function jsonToArray($data)
    {
        return json_decode($data,true);
    }

}
