<?php

namespace App\Http\Controllers\Providers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class BaseServiceProviders extends Controller
{

    protected $dbtable_prefix="prosystem";
    protected $system_numbers=[0,1];

    public function topUsers()
    {
        return $this->system_numbers;
    }

    public function dateFormat($data)
    {
        return date("Y-m-d H:i:s",$data);
    }

    public function dbTable($table=array())
    {
        if(count($table))
        {
            $data['words']="".$this->dbtable_prefix."_words";
            $data['admin']="".$this->dbtable_prefix."_administrator";
            $data['logs']="".$this->dbtable_prefix."_administrator_process_logs";
            $data['api']="".$this->dbtable_prefix."_api_accesses";
            $data['mysql_slow']="".$this->dbtable_prefix."_mysql_slow_process_logs";
            $data['roles']="".$this->dbtable_prefix."_roles";

            if($table[0]=="all")
            {
                return $data;
            }
            return $data[$table[0]];
        }
    }
    public function menuStatu($value)
    {
        $menu['small']['ul']='page-sidebar-menu page-sidebar-menu-hover-submenu page-sidebar-menu-closed ';
        $menu['small']['body']='page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-sidebar-closed page-sidebar-closed-hide-logo';

        $menu['normal']['ul']='page-sidebar-menu page-sidebar-menu-hover-submenu ';
        $menu['normal']['body']='page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo';

        return $menu[$value];

    }

    public function getLang($data)
    {
        //default word data
        $getWordDefault=DB::table($this->dbTable(['words']))->where(['url_path'=>'default','lang'=>$data['lang']])->get();

        //requested word data
        $getWord=DB::table($this->dbTable(['words']))->where($data)->get();

        if(count($getWord)==false)
        {
            //return
            $this->insertLang(['url_path'=>$data['url_path'],'word_data'=>['dashboard'=>'Test Sayfası','dashboard_info'=>'Test Sayfası Oluşturuldu'],'lang'=>1]);
            return array_merge(json_decode($getWordDefault[0]->word_data,true),json_decode(json_encode(array()),true));
        }

        //return
        return array_merge(json_decode($getWordDefault[0]->word_data,true),json_decode($getWord[0]->word_data,true));
    }


    public function insertLang($data)
    {
        //data param : get json encode key : word_data
        $data['word_data']=json_encode($data['word_data']);
        $data['updated_at']=time();

        //see existing data for sql table
        $wordExist=DB::table($this->dbTable(['words']))
            ->where("url_path","=",$data['url_path'])
            ->where("lang","=",$data['lang'])
            ->get();
        //count true
        if(count($wordExist))
        {
            //existing word data
            $word_data=json_decode($wordExist[0]->word_data,true);

            //check if is_array not
            if(is_array($word_data))
            {
                //array_merge old_data and new data
                $word_data=array_merge($word_data,json_decode($data['word_data'],true));
                $data['word_data']=json_encode($word_data);
            }

            //count true return
            return DB::table($this->dbTable(['words']))
                ->where("url_path",$data['url_path'])
                ->where("lang",$data['lang'])
                ->update($data);

        }

        //default true return
        return DB::table($this->dbTable(['words']))->insert($data);
    }


    public function passwordHash($data)
    {
        //complexity password info
        $password_info=''.$data.'___xcKlM34proX';

        //return and hash password
        return md5(sha1(base64_encode($password_info)));
    }


    public function loginSessionHash($data)
    {
        $sessionHash=''.$data[0]->id.'__'.$data[0]->password.'__'.$_SERVER['HTTP_USER_AGENT'].'__'.time().'__prpH';
        return md5(sha1(base64_encode($sessionHash)));
    }


    public function loginPost($data)
    {
        $data['password']=$this->passwordHash($data['password']);
        return DB::table($this->dbTable(['admin']))->where(['ccode'=>$data['ccode'],'username'=>$data['username'],'password'=>$data['password']])->get();
    }


    public function updateUserHash($hash,$id)
    {
        return DB::table($this->dbTable(['admin']))->where(['id'=>$id])->update(['hash'=>$hash,'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>1,'last_login_time'=>time()]);
    }

    public function pageProtector($field=false)
    {
        if($field)
        {
            $query=DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>1])->get();

            $adminFields=['lang'=>config("app.default_lang"),'role'=>1,'id'=>1];
            if(count($query))
            {
                foreach ($field as $fieldval)
                {
                    $adminFields[$fieldval] = $query[0]->$fieldval;
                }

                return (object)$adminFields;
            }
            return (object)$adminFields;
        }

        return DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>1])->get();
    }


    public function adminLock()
    {
        return DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>1])->update(['user_lock'=>0]);
    }

    public function get_admin_for_lockScreen()
    {
        return DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>0])->get();
    }

    public function admin()
    {
        return $this->pageProtector(['id','username','fullname','photo','lang','role','ccode','system_name','phone_number','address','occupation','website','extra_info',
                                     'created_at','last_login_time','user_where','last_ip','email','system_number']);
    }

    public function adminUpdate()
    {
        return DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>1])->update(['updated_at'=>time()]);
    }

    public function pageRole($data=array())
    {
        if(count($data))
        {
            $adminRole=explode("-",$data['admin']);

            if(in_array($data['pageRole'],$adminRole))
            {
                return true;
            }
            return false;
        }

    }


    public function getOnlineStatu($id=false)
    {
        if($id)
        {
            $data=DB::table($this->dbTable(['admin']))->where("id","=",$id)->get();
            $config_expire_time=60*config("app.online_expire_minute");
            $user_expire_time=$data[0]->updated_at+$config_expire_time;

            if(time()>$user_expire_time)
            {
                $status=['status'=>false];
                return (object)$status;
            }

            $status=['status'=>true];
            return (object)$status;


        }
    }


    public function getLogs($data=array())
    {
        if(count($data))
        {
            if(array_key_exists("id",$data))
            {
                return DB::table($this->dbTable(['logs']))->where("userid","=",$data['id'])->orderBy("created_at","desc")->take(10)->get();
            }
        }
    }


    public function updateLogInfo($admin=false,$data=array())
    {
        if(count($data))
        {
            return DB::table($this->dbTable(['logs']))->where("userid","=",$admin)->orderBy("created_at","desc")->take(1)->update($data);
        }
    }


    public function getvalidPostKey($data,$invalid=array())
    {
        if(count($invalid))
        {
            foreach ($data as $valid_key=>$valid_val)
            {
                if(!in_array($valid_key,$invalid))
                {
                    $validKeys[$valid_key]=$valid_val;
                }
            }

            return $validKeys;
        }

    }

}
