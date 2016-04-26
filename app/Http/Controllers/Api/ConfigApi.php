<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class ConfigApi extends Controller
{

    public $request;
    public $app;
    public $controller;
    public $model;
    public $version='V1'; //ucfirst

    public function __construct(Request $request)
    {
        //request class
        $this->request = $request;
        //base service provider
        $this->app = app()->make("Base");
    }


    public function get()
    {
        return ['asa'];
    }

    public function table ($table)
    {
        return $this->app->dbTable([$table]);
    }

    public function select()
    {
        if($this->request->header("select"))
        {
            return json_decode($this->request->header("select"),true);
        }

        return '*';
    }

    public function where()
    {
        if($this->request->header("where"))
        {
            return json_decode($this->request->header("where"),true);
        }

        return [];
    }


    public function update()
    {
        if($this->request->header("update"))
        {
            return json_decode($this->request->header("update"),true);
        }

        return [];
    }


    public function pageNumber()
    {
        if($this->request->header("pageNumber"))
        {
            return $this->request->header("pageNumber")-1;
        }

        return 0;
    }

    public function postdata()
    {
        return $this->app->getvalidPostKey(json_decode($this->request->header("postdata"),1),['_token']);
    }


    public function output($query)
    {
        if(count($query))
        {
            $result=['success'=>true,'query'=>$query];
        }
        else
        {
            $result=['success'=>false,'query'=>$query];
        }

        return response()->json($result);
    }



}