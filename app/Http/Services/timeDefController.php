<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class timeDefController extends Controller
{
    public $app;
    public $admin;

    public function __construct ()
    {
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
        $this->app->insertLang(['url_path'=>'default','word_data'=>['approximately'=>'Yaklaşık'],'lang'=>1]);

    }

    public function getPassing($data,$detail=false)
    {
        //second data
        $passingTime=time()-$data;
        //minute data
        $minute=floor($passingTime/60);
        //hour data
        $hour=floor($passingTime/3600);
        //day data
        $day=floor($passingTime/86400);
        //month data
        $month=floor($passingTime/2592000);
        //year data
        $year=floor($passingTime/31104000);

        if($detail==false)
        {
            //year true
            if($year>0)
            {
                //return
                $passingData=['data'=>$year,'unit'=>'y','define'=>'year_before','output'=>''.$this->data['approximately'].' '.$year.' '.$this->data['year'].' '.$this->data['before'].''];
                return (object)$passingData;
            }

            //month true
            if($month>0)
            {
                //return
                $passingData=['data'=>$month,'unit'=>'m','define'=>'month_before','output'=>''.$this->data['approximately'].' '.$month.' '.$this->data['month'].' '.$this->data['before'].''];
                return (object)$passingData;
            }

            //day true
            if($day>0)
            {
                //return
                $passingData=['data'=>$day,'unit'=>'d','define'=>'day_before','output'=>''.$this->data['approximately'].' '.$day.' '.$this->data['day'].' '.$this->data['before'].''];
                return (object)$passingData;
            }

            //hour true
            if($hour>0)
            {
                //return
                $passingData=['data'=>$hour,'unit'=>'h','define'=>'hour_before','output'=>''.$this->data['approximately'].' '.$hour.' '.$this->data['hour'].' '.$this->data['before'].''];
                return (object)$passingData;
            }

            //minute true
            if($minute>0)
            {
                //return
                $passingData=['data'=>$minute,'unit'=>'i','define'=>'minute_before','output'=>''.$this->data['approximately'].' '.$minute.' '.$this->data['minute'].' '.$this->data['before'].''];
                return (object)$passingData;
            }
            else
            {
                //minute false second data
                $passingData=['data'=>$passingTime,'unit'=>'s','define'=>'second_before','output'=>''.$this->data['approximately'].' '.$passingTime.' '.$this->data['second'].' '.$this->data['before'].''];
                return (object)$passingData;
            }
        }

    }



    public function convertDate($data)
    {
       return $data/60;
    }
}
