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
        //get admin for session
        $hashCheck=\DB::table(app()->make("Base")->dbTable(['admin']))->where("hash","=",Session("userHash"))->get();

        //page protector false
        if(count(app()->make("Base")->pageProtector())==false)
        {
            if ($request->ajax())
            {
                //is mobile
                return response('Unauthorized.', 401);
            }
            else
            {
                //session check
                if(Session("userHash"))
                {
                    //if there is session,but if hash value has been changed or online statu false
                    if(count($hashCheck))
                    {
                        //redirect logout
                        return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/logout');
                    }

                }

                //redirect false
                return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/login');

            }
        }

        //page protector true but online statu false
        if(app()->make("Base")->getOnlineStatu($hashCheck[0]->id)->status==false)
        {
            //online statu false
            return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/logout');
        }

        //admin update false
        if(app()->make("Base")->adminUpdate()==false)
        {
            //admin update false
            return redirect()->guest(''.strtolower(config("app.admin_dirname")).'/logout');
        }

        DB::enableQueryLog();

        return $next($request);




    }
}
