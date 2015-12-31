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
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab2'=>'Hesabım'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab3'=>'Yetkiler'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['profile_tab4'=>'Görevler'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['warning'=>'Uyarı'],"lang"=>1]);
        $this->app->insertLang(["url_path"=>"profile","word_data"=>['warning_profil_picture_size'=>'Lütfen büyük resimler yüklemeye özen gösteriniz.'],"lang"=>1]);

        return $next($request);
    }
}
