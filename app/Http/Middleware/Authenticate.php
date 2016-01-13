<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Input;
use Session;


class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
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
                if(Session("userHash"))
                {
                    return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/logout');
                }

                return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/login');

            }
        }

        if(app()->make("Base")->adminUpdate()==false)
        {
            return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/logout');
        }

        DB::enableQueryLog();

        return $next($request);




    }
}
