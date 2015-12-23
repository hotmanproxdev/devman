<?php

namespace App\Http\Middleware;

use Closure;

class adminLock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(app()->make("Base")->adminLock()==false)
        {
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            redirect("".strtolower(config("app.admin_dirname"))."/home");
        }
        return $next($request);
    }
}
