<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class outPutController extends Controller
{

    public $request;
    public $app;
    public $data;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request method
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page lang
        $this->data=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);
    }

    public function PdfDownload($data=false,$file=false,$attribute=array())
    {
        if($data && $file)
        {
            return \Pdf::loadHTML($data)->setPaper('a4', 'landscape')->setWarnings(false)->download(''.$file.'.pdf');
        }
    }


    public function PdfStream($data=false,$file=false,$attribute=array())
    {
        if($data && $file)
        {
            return \Pdf::loadHTML($data)->setPaper('a4', 'landscape')->setWarnings(false)->stream(''.$file.'.pdf');
        }
    }

    public function PdfSave($data=false,$file=false,$attribute=array())
    {
        if($data && $file)
        {
            return \Pdf::loadHTML($data)->setPaper('a4', 'landscape')->setWarnings(false)->save(''.$file.'.pdf');
        }
    }
}
