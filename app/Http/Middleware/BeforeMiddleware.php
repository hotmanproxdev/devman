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

        //last move register for administrator table
        DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update(['user_where'=>$this->request->getPathInfo()]);

        $this->app->insertLang(["url_path"=>"users","word_data"=>['new_user_status'=>'Kullanıcı Statüsü'],"lang"=>1]);
        //$this->app->insertLang(["url_path"=>"default","word_data"=>['user_capter_menu'=>'Kullanıcılar Bölümü'],"lang"=>1]);
        //$this->app->insertLang(["url_path"=>"default","word_data"=>['log_false'=>'Config dosyasında log tutma kapatılmış.Lütfen sistem geliştiricisine başvurunuz.'],"lang"=>1]);


        return $next($request);
    }
}
