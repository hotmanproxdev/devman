<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;

class AfterMiddleware
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $request;

    /**
     * Create a new middleware instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request=$request;
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
        $response = $next($request);

        if(config("app.mysql_slow_status"))
        {
            $mysqlLog=DB::getQueryLog();

            for ($i=0;$i<count($mysqlLog);$i++) {

                if($mysqlLog[$i]['time']>1)
                {
                    DB::table("prosystem_mysql_slow_process_logs")->insert([
                        'url_path'=>$this->request->fullUrl(),
                        'query_log' => $mysqlLog[$i]['query'],
                        'query_bindings' =>json_encode($mysqlLog[$i]['bindings']),
                        'query_time' => $mysqlLog[$i]['time'],
                        'created_at' =>time()
                    ]);
                }


            }
        }



        return $response;
    }
}
