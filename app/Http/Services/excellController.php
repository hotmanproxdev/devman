<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\Matcher\Not;
use Notification;
use Input;

class excellController extends Controller
{
    public $notification;

    public function __construct(Notification $notification)
    {
        //page protector
        $this->middleware('auth');
        //notification
        $this->notification=$notification;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function get($data=array())
    {
        return \Excel::create('Filename', function($excel)
        {

            $excel->sheet('Sheetname', function($sheet)
            {

                $sheet->fromModel(\App\Models\Menu::all());
                // Set auto filter for a range
                $sheet->setAutoFilter('A1:B1');
                $sheet->setAutoSize(true);

                $sheet->cells('A1:J1', function($cells) {

                    $cells->setBackground('#336699');
                    $cells->setFontColor('#ffffff');

                    // Set font weight to bold
                    $cells->setFontWeight('bold');
                    $cells->setValignment('center');

                });
            });
        })->export('xls');
    }
}
