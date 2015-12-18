<?php

namespace App\Http\Controllers\Providers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseServiceProviders extends Controller
{
    public function test()
    {
        if(preg_match('@local@is',gethostname()))
        {
            return $this->json(['env'=>'developer']);
        }

        return $this->json(['env'=>'production']);
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
