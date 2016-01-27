<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class paginationController extends Controller
{

    public $page;
    public $maxresult;

    public function number($foo)
    {
        $this->maxresult=$foo;
        return $this;
    }

    public function number2($max)
    {
        $this->maxresult=$this->maxresult*$max;
        return $this;
    }

    public function calc()
    {
        return $this->maxresult;
    }

    public function xx()
    {
        return 'asa';
    }
}
