<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class paginationController extends Controller
{

    public function test($callback)
    {
        $val=false;

        if($val)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        return 'asa';


    }
}
