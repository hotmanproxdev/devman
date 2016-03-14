<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use BrowserDetect;
use GeoIP;

class putLogController extends Controller
{
    public $request;
    public $app;
    public $data;
    public $post;
    public $admin;

    public function __construct(Request $request)
    {
        //page protector
        $this->middleware('auth');
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
    }
    public function admin($log=array(),$post=array())
    {
        if(!preg_match('@^\/api.*@',$this->request->getPathInfo()))
        {
            $data['userid']=$this->admin->id;
            $data['ccode']=$this->app->ccode($this->admin->ccode);

            $data['userip']=ip2long($this->request->ip());
            $data['ip']=$this->request->ip();
            $data['userHash']=$this->admin->hash;

            foreach (GeoIP::getLocation() as $key=>$value)
            {
                if(($key!=="ip") AND ($key!=="default"))
                {
                    $data[$key]=$value;
                }
            }

            foreach (BrowserDetect::toArray() as $key=>$value)
            {
                $data[$key]=$value;
            }

            $data['referer']=$this->request->header("referer");
            $data['formprocess']=($this->request->ajax()) ? 'Ajax Request' : 'Normal Request';

            $data['user_agent']=$this->request->header('user-Agent');
            $data['user_host']=$this->request->header('host');
            $data['user_host']='';

            $data['url_path']=$this->request->fullUrl();
            $data['url_path_explain']=$this->request->getPathInfo();
            $data['log_process']=(array_key_exists("_token",$post)) ? 2 : 1;
            $data['msg']='access';
            $data['postdata']=(array_key_exists("_token",$post)) ? json_encode($post) : json_encode([]);
            $data['getdata']=(!array_key_exists("_token",$post)) ? json_encode($post) : json_encode([]);
            $data['created_at']=time();

            if(DB::table($this->app->dbTable(['logs']))->insert($data))
            {
                return DB::table($this->app->dbTable(['log_statistics']))
                                ->where("id","=",1)
                                ->update(['log'=>$this->getAllLogCounter(),'updated_at'=>time()]);
            }
        }


    }


    public function getAllLogCounter()
    {
        $query=DB::table($this->app->dbTable(['log_statistics']))->where("id","=",1)->get();

        if($query[0]->log==NULL)
        {
            //log counter
            $log['log_counter']=1;

            //ccode counter
            $log['ccode'][$this->admin->ccode]=1;

            //ccode username counter
            $log['user']['ccode'][$this->admin->ccode][$this->admin->id]=1;


            //osFamily counter
            $browserDetect=BrowserDetect::toArray();
            $log['family']['osFamily'][$browserDetect['osFamily']]=1;
            $log['family']['ccode'][$this->admin->ccode]['osFamily'][$browserDetect['osFamily']]=1;

            //browserFamily counter
            $log['family']['browserFamily'][$browserDetect['browserFamily']]=1;
            $log['family']['ccode'][$this->admin->ccode]['browserFamily'][$browserDetect['browserFamily']]=1;

        }
        else
        {
            $log=json_decode($query[0]->log,1);

            //log counter
            $log['log_counter']=$log['log_counter']+1;

            //ccode counter
            if(array_key_exists($this->admin->ccode,$log['ccode']))
            {
                $log['ccode'][$this->admin->ccode]=$log['ccode'][$this->admin->ccode]+1;
            }
            else
            {
                $log['ccode'][$this->admin->ccode]=1;
            }


            //ccode username counter
            if(array_key_exists($this->admin->ccode,$log['user']['ccode']))
            {
                if(array_key_exists($this->admin->id, $log['user']['ccode'][$this->admin->ccode]))
                {
                    $log['user']['ccode'][$this->admin->ccode][$this->admin->id]=$log['user']['ccode'][$this->admin->ccode][$this->admin->id]+1;
                }
                else
                {
                    $log['user']['ccode'][$this->admin->ccode][$this->admin->id]=1;
                }

            }
            else
            {
                $log['user']['ccode'][$this->admin->ccode][$this->admin->id]=1;
            }

            //get browserdetect
            $browserDetect=BrowserDetect::toArray();

            //osFamily counter
            if(array_key_exists($browserDetect['osFamily'],$log['family']['osFamily']))
            {
                $log['family']['osFamily'][$browserDetect['osFamily']]=$log['family']['osFamily'][$browserDetect['osFamily']]+1;
            }
            else
            {
                $log['family']['osFamily'][$browserDetect['osFamily']]=1;
            }

            //browserFamily counter
            if(array_key_exists($browserDetect['browserFamily'],$log['family']['browserFamily']))
            {
                $log['family']['browserFamily'][$browserDetect['browserFamily']]=$log['family']['browserFamily'][$browserDetect['browserFamily']]+1;
            }
            else
            {
                $log['family']['browserFamily'][$browserDetect['browserFamily']]=1;
            }


            //osFamily ccode counter
            if(array_key_exists($this->admin->ccode,$log['family']['ccode']))
            {
                if(array_key_exists("osFamily",$log['family']['ccode'][$this->admin->ccode]))
                {
                    if(array_key_exists($browserDetect['osFamily'],$log['family']['ccode'][$this->admin->ccode]['osFamily']))
                    {
                        $log['family']['ccode'][$this->admin->ccode]['osFamily'][$browserDetect['osFamily']]=$log['family']['ccode'][$this->admin->ccode]['osFamily'][$browserDetect['osFamily']]+1;
                    }
                    else
                    {
                        $log['family']['ccode'][$this->admin->ccode]['osFamily'][$browserDetect['osFamily']]=1;
                    }
                }
                else
                {
                    $log['family']['ccode'][$this->admin->ccode]['osFamily'][$browserDetect['osFamily']]=1;
                }

            }
            else
            {
                $log['family']['ccode'][$this->admin->ccode]['osFamily'][$browserDetect['osFamily']]=1;
            }


            //browserFamily ccode counter
            if(array_key_exists($this->admin->ccode,$log['family']['ccode']))
            {
                if(array_key_exists("browserFamily",$log['family']['ccode'][$this->admin->ccode]))
                {
                    //browserFamily ccode counter
                    if(array_key_exists($browserDetect['browserFamily'],$log['family']['ccode'][$this->admin->ccode]['browserFamily']))
                    {
                        $log['family']['ccode'][$this->admin->ccode]['browserFamily'][$browserDetect['browserFamily']]=
                            $log['family']['ccode'][$this->admin->ccode]['browserFamily'][$browserDetect['browserFamily']]+1;
                    }
                    else
                    {
                        $log['family']['ccode'][$this->admin->ccode]['browserFamily'][$browserDetect['browserFamily']]=1;
                    }
                }
                else
                {
                    $log['family']['ccode'][$this->admin->ccode]['browserFamily'][$browserDetect['browserFamily']]=1;
                }

            }
            else
            {
                $log['family']['ccode'][$this->admin->ccode]['browserFamily'][$browserDetect['browserFamily']]=1;
            }




        }


        return json_encode($log);
    }


}
