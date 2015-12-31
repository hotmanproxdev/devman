<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;

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

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get admin
        $this->admin=$this->app->admin();
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
        DB::table("prosystem_administrator")->where("id","=",$this->admin->id)->update(['user_where'=>$this->request->getPathInfo()]);
        //$this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab2'=>'Hesabım'],"lang"=>1]);


        return $next($request);
    }
}
