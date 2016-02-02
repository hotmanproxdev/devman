<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mockery\Matcher\Not;
use Notification;
use Input;

class dbTransactionController extends Controller
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

    public function commit($callback)
    {

        //transaction start
        \DB::beginTransaction();
        try
        {
            //callback function
            if(is_callable($callback))
            {
                //callback
                call_user_func($callback);
            }

            //commit
            \DB::commit();
            //boolean
            return true;

        }
        catch (\Exception $e)
        {
            //rollback
            \DB::rollback();

            //boolean
            return false;
        }


    }
}
