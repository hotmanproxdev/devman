<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use App\Http\Services\putLogController as log;
use Input;

class BeforeMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $request;
    protected $app;
    protected $admin;
    protected $log;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Request $request,log $log)
    {
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get admin
        $this->admin=$this->app->admin();
        //get log
        $this->log=$log;

    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(config("app.log_status"))
        {
            $this->log->admin(['access','request','request'],Input::all());
        }


            $time_spent=time()-$this->admin->last_login_time;
            $all_time_spent=$this->admin->all_time_spent+$time_spent;

            if($this->admin->all_hash_number==0)
            {
                $all_average_time_spent_for_every_hash=0;
            }
            else
            {
                $all_average_time_spent_for_every_hash=$all_time_spent/$this->admin->all_hash_number;
            }


        if($this->admin->last_filter_data>0)
        {
            $lastpost=base64_decode($this->admin->last_post);
            $lastpost=json_decode($lastpost,true);

            if(!preg_match('@'.$this->request->getPathInfo().'@',$lastpost['request']))
            {
                if(!preg_match('@^\/api.*@',$this->request->getPathInfo()))
                {
                    //last move register for administrator table
                    $query=DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update(['user_where'=>$this->request->getPathInfo(),'all_time_spent'=>DB::raw('last_hash_time_spent+'.$time_spent),
                        'hash_time_spent'=>$time_spent,'all_average_time_spent_for_every_hash'=>$all_average_time_spent_for_every_hash,'last_filter_data'=>0]);

                    if($query)
                    {
                        \Session::forget("filterdata");
                    }
                }

            }
        }
        else
        {
            //last move register for administrator table
            DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update(['user_where'=>$this->request->getPathInfo(),'all_time_spent'=>DB::raw('last_hash_time_spent+'.$time_spent),
                'hash_time_spent'=>$time_spent,'all_average_time_spent_for_every_hash'=>$all_average_time_spent_for_every_hash]);
        }




        $this->app->insertLang(["url_path"=>"logs","word_data"=>['systemcodepiebrowserfamilytextccode'=>'Grubunuzda ki Tüm browserFamily Platform Sayıları'],"lang"=>1]);


        return $next($request);
    }
}
