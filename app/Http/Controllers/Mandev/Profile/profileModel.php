<?php

namespace App\Http\Controllers\Mandev\Profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class profileModel extends Controller
{
    public $request;
    public $app;
    public $admin;
    public $url_path='profile';

    public function __construct (Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
        //page role
        $this->data['pageRole']=$this->app->pageRole(['pageRole'=>1,'admin'=>$this->admin]);

    }

    public function updateProfile($data,$id)
    {
        if(count($data))
        {
            //transaction start
            DB::beginTransaction();
            try
            {
                //update profile query
                DB::table($this->app->dbTable(['admin']))->where("id","=",$id)->update($this->app->getValidPostKey($data,['_token','ccode','hidden_input']));
                //commit
                DB::commit();
            }
            catch (\Exception $e)
            {
                //rollback
                DB::rollback();
                //boolean
                return false;
            }

            //boolean
            return true;
        }


    }

    public function changePassword($data=false,$id)
    {
        if($data)
        {
            //db table update true
            if(DB::table($this->app->dbTable(['admin']))->where("id","=",$id)->update(['password'=>$this->app->passwordHash($data)]));
            {
                if($this->admin->id==$id)
                {
                    //userhash forget
                    Session::forget('userHash');
                }

                return true;
            }

            return false;
        }

    }


    public function uploadUpdate($file,$id)
    {
        return DB::table($this->app->dbTable(['admin']))->where("id","=",$id)->update(['photo'=>$file]);
    }

    public function roleUpdate($data,$id)
    {
        $datarole=explode("-",$data['default_roles']);
        $getrole=DB::table($this->app->dbTable(['default_roles']))->where("system_number","=",$datarole[0])->get();

        if(count($getrole))
        {
            $role_assign=implode("@",$_POST['role_assign']);
            return DB::table($this->app->dbTable(['admin']))->where("id","=",$id)->update(['system_name'=>$getrole[0]->role_name,'system_number'=>$getrole[0]->system_number,'role'=>$role_assign]);
        }

        return false;

    }


}
