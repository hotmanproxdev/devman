<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class activitiesChartController extends Controller
{

    public function __construct()
    {
        //page protector
        $this->middleware('auth');
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function lineChart($data=array())
    {
        $this->data['chartData']=$data;


        foreach ($data['chart_number'] as $cnokey=>$cnoval)
        {
            $list=array();

            if(!array_key_exists("amount",$data))
            {
                $this->data['chartData']['amount'][$cnokey]='';
            }

            foreach ($data['data'][$cnokey] as $key=>$chart)
            {
                $list[]='["'.$key.'",'.$chart.']';
            }

            $this->data['chartData']['chart_number'][$cnokey]=$cnoval;
            $this->data['chartData']['data'][$cnokey]=implode(",",$list);
        }




        //return view
        return view("".config("app.admin_dirname").".activities_chart",$this->data);

    }
}
