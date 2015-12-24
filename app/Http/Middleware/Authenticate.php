<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Input;
use App\Http\Services\putLogController as log;


class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;
    protected $log;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth,log $log)
    {
        $this->auth = $auth;
        $this->log=$log;
        if(config("app.log_status"))
        {
            $this->log->admin(['access','request','request'],Input::all());
        }
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
        if(count(app()->make("Base")->pageProtector())==false)
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/login');
            }
        }

        if(app()->make("Base")->adminUpdate()==false)
        {
            return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/login');
        }

        DB::enableQueryLog();

        return $next($request);




    }
}
