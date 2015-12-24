<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class AfterMiddleware implements Middleware
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
        $response = $next($request);

        DB::table("prosystem_administrator_process_logs")->insert(['id'=>1,'userid'=>1]);

        return $response;
    }
}
