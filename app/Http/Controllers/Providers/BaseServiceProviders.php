<?php

namespace App\Http\Controllers\Providers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

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
            $data['default_roles']="".$this->dbtable_prefix."_default_roles";
            $data['api_custom']="".$this->dbtable_prefix."_api_custom_models";
            $data['ccodes']="".$this->dbtable_prefix."_admin_ccodes";
            $data['log_statistics']="".$this->dbtable_prefix."_log_statistics";
            $data['log_updated']="".$this->dbtable_prefix."_log_updated";

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


    public function getLang($data=false,$lang=false)
    {
        if($lang)
        {
            $data['lang']=$lang;
        }
        //default word data
        $getWordDefault=DB::table($this->dbTable(['words']))->where(['url_path'=>'default','lang'=>$data['lang']])->get();

        if($data)
        {
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

        return array_merge(json_decode($getWordDefault[0]->word_data,true),[]);

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
        $update=DB::table($this->dbTable(['admin']))->where(['id'=>$id]);
        $user=$update->get();

        if(count($user))
        {
            if($user[0]->first_hash_time==0)
            {
                $update->update(['hash'=>$hash,
                    'first_hash_time'=>time(),
                    'last_hash'=>$hash,
                    'updated_at'=>time()-1,
                    'last_ip'=>$_SERVER['REMOTE_ADDR'],
                    'user_lock'=>1,
                    'last_login_time'=>time(),
                    'logout'=>0,
                    'logout_time'=>0,
                    'hash_clicked'=>0,
                    'all_hash_number'=>DB::raw('all_hash_number+1')]);

                return true;
            }
             else
             {
                 $update->update(['hash'=>$hash,
                     'last_hash'=>$hash,
                     'updated_at'=>time()-1,
                     'last_ip'=>$_SERVER['REMOTE_ADDR'],
                     'user_lock'=>1,
                     'last_login_time'=>time(),
                     'logout'=>0,
                     'logout_time'=>0,
                     'hash_clicked'=>0,
                     'all_hash_number'=>DB::raw('all_hash_number+1')]);

                 return true;
             }
        }

        return false;
    }

    public function pageProtector($field=false,$id=0)
    {
        if($field)
        {
            if($id==0)
            {
                $query=DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),'last_ip'=>$_SERVER['REMOTE_ADDR'],'user_lock'=>1])->get();
            }
            else
            {
                $query=DB::table($this->dbTable(['admin']))->where('id','=',$id)->get();
            }

            $adminFields=$this->getTableFields("admin",1);
            if(!$id)
            {
                $adminFields['id']=1;
            }

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

    public function admin($id=0)
    {
        return $this->pageProtector($this->getTableFields("admin"),$id);
    }

    public function adminUpdate()
    {
        $browser=\BrowserDetect::toArray();
        return DB::table($this->dbTable(['admin']))->where(['hash'=>Session("userHash"),
                                                            'last_ip'=>$_SERVER['REMOTE_ADDR'],
                                                            'user_lock'=>1])->update(['updated_at'=>time(),
                                                                                      'is_mobile'=>$browser['isMobile'],
                                                                                      'is_tablet'=>$browser['isTablet'],
                                                                                      'is_desktop'=>$browser['isDesktop'],
                                                                                      'is_bot'=>$browser['isBot'],
                                                                                      'browser_family'=>$browser['browserFamily'],
                                                                                      'os_family'=>$browser['osFamily'],
                                                                                      'all_clicked'=>DB::raw('all_clicked+1'),
                                                                                      'hash_clicked'=>DB::raw('hash_clicked+1')
                                                                                      ]);
    }

    public function pageRole($data=array())
    {
        if(count($data))
        {
            if($data['admin']->system_number==0)
            {
                return true;
            }
            $adminRole=explode("@",$data['admin']->role);

            if(in_array($data['pageRole'],$adminRole))
            {
                return true;
            }
            DB::table($this->dbTable(['admin']))->where("id","=",$data['admin']->id)->update(['noauth_area_operations'=>DB::raw('noauth_area_operations+1')]);
            DB::table($this->dbTable(['logs']))->where("userid","=",$data['admin']->id)->where("userHash","=",$data['admin']->hash)->orderBy("id","desc")->take(1)->update(['url_path_valid'=>0,'noauth_area_operations'=>1]);
            return false;
        }

    }


    public function getOnlineStatu($id=false)
    {
        if($id)
        {
            $data=DB::table($this->dbTable(['admin']))->where("id","=",$id)->where("logout","=",0)->get();

            if(count($data))
            {
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

            $status=['status'=>false];
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
            if(array_key_exists("manipulation",$data))
            {
                if(array_key_exists("fail_operations",$data))
                {
                    $usersmanipulation['fail_operations']=DB::raw("fail_operations+1");
                }
                $usersmanipulation['manipulation']=DB::raw("manipulation+1");
                $usersmanipulation['noauth_area_operations']=DB::raw("noauth_area_operations+1");

                DB::table($this->dbTable(['admin']))->where("id","=",$admin)->update($usersmanipulation);
            }
            return DB::table($this->dbTable(['logs']))->where("userid","=",$admin)->orderBy("created_at","desc")->take(1)->update($data);
        }
    }


    public function getvalidPostKey($data,$invalid=array())
    {
        $validKeys=[];
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


    public function getUserRoles($data=array())
    {
        if(array_key_exists("admin",$data))
        {
            $roles = DB::table($this->dbTable(['roles']))->where("lang", "=", $data['admin']->lang)->where("status", "=", "1")->get();
            $admin_roles = DB::table($this->dbTable(['admin']))->select("role")->where("id", "=", $data['admin']->id)->get();

            $adminrole = explode("@", $admin_roles[0]->role);

            foreach ($roles as $role) {
                if (in_array($role->id, $adminrole)) {
                    $roleInput[$role->id] = 'checked="checked"';
                } else {
                    $roleInput[$role->id] = '';
                }
            }

            $default_roles = DB::table($this->dbTable(['default_roles']))->where("system_number", ">", 0)->orderBy("role_row", "asc")->get();
            foreach ($default_roles as $defroles) {
                $def_roles[$this->getLang(false, $data['admin']->lang)[$defroles->role_name]] = ['id' => $defroles->id, 'system_number' => $defroles->system_number, 'roles' => $defroles->roles];
            }

            return ['roles' => $roles, 'checkbox' => $roleInput, 'default_roles' => $def_roles];

        }

        if(array_key_exists("default_roles",$data))
        {
            return DB::table($this->dbTable(['default_roles']))->where("system_number", "=", $data['default_roles'])->get();

        }

        if(array_key_exists("role_define",$data))
        {
            return DB::table($this->dbTable(['default_roles']))->where("role_define", "=", $data['role_define'])->get();

        }
    }


    public function getUsers($id,$select="*")
    {
        return DB::table($this->dbTable(['admin']))->select($select)->where("id","=",$id)->get();
    }

    public function controlQuestToKnow($ip)
    {
        if(Session("tempHash"))
        {
            $user=DB::table($this->dbTable(['admin']))->where("last_hash","=",Session("tempHash"))->orderBy("id","desc")->take(1)->get();
            if(count($user))
            {
                return DB::table($this->dbTable(['logs']))->where("userid","=",0)->where("userip","=",$user[0]->last_ip)->update(['userid'=>$user[0]->id,'userHash'=>$user[0]->last_hash]);
            }
        }

    }

    public function getApiHash($data=array())
    {
        $ccode=''.$data['ccode'].'__systemapiccode';
        $ip=''.$data['ip'].'__systemapiip';
        $key=''.$data['key'].'__systemapikey';

        return md5(sha1(''.$ccode.'__'.$ip.'__'.$key.'__'.time().''));
    }

    public function getApiStandartKey($id)
    {
        $standart_key=''.$id.'__%&___??';
        return md5(sha1(base64_encode($standart_key)));
    }


    public function systemNumberCheck()
    {
        return $this->system_numbers;
    }

    public function getTableFields($table,$data=false)
    {
        $query=DB::table($this->dbTable([$table]))->take(1)->get();
        $query=json_decode(json_encode($query[0]),1);

        foreach ($query as $field=>$val)
        {
            $list[]=$field;
        }

        if($data)
        {
            return $query;
        }
        return $list;

    }


    public function admin_success_point($id)
    {
        //get user info
        $user=$this->getUsers($id,['all_time_spent',
                                   'all_clicked',
                                   'all_average_time_spent_for_every_hash',
                                   'all_hash_number','success_operations',
                                   'fail_operations','manipulation',
                                   'noauth_area_operations']);

        //get success operations of users
        $success_operations=$user[0]->success_operations+1;

        //get fail operations of users
        $fail_operations=$user[0]->fail_operations+1;

        //get manipulation of users
        $manipulation=$user[0]->manipulation+1;

        //get noauth_area_operations of users
        $noauth_area_operations=$user[0]->noauth_area_operations+1;

        //operations process calculate
        $operation_process=number_format($success_operations/$fail_operations/$manipulation/$noauth_area_operations,2,'.','.')+0.01;

        //all hash number false
        if($user[0]->all_hash_number==0)
        {
            return 0;
        }

        //all_average_time_spent_for_every_hash
        $all_average_time_spent_for_every_hash=(int)$user[0]->all_time_spent;

        //all hash number
        $all_hash_number=$user[0]->all_hash_number+1;

        //point calculate
        $point=$all_average_time_spent_for_every_hash*$all_hash_number;
        $point=$point*$operation_process;

        return (int)$point/1000;
    }



    public function services($access=false)
    {
        if($access)
        {
            //default service
            $services[]='test';

            //db table services
            foreach ($this->dbTable(['all']) as $tabkey=>$tabindex)
            {
                $services[]=$tabkey;
            }

            $apicustom=DB::table($this->dbTable(['api_custom']))->get();

            if(count($apicustom))
            {
                foreach ($apicustom as $custom)
                {
                    $services[]=$custom->custom_models;
                }
            }


            //return
            return $services;
        }

    }


    public function ccode ($ccode=false)
    {
        if($ccode)
        {
            $query=DB::table($this->dbTable(['ccodes']))->where("ccode","=",$ccode)->get();

            return $query[0]->id;
        }
    }


    public function getField($data)
    {
        foreach ($data[0] as $key=>$value)
        {
            $list[]=$key;
        }

        return $list;
    }






}
