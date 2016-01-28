<?php

namespace App\Http\Controllers\Api\Custom;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;

class GetSameIpUsersApi extends Controller
{

    public $request;
    public $app;

    public function __construct (Request $request)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
    }

    public function get ()
    {
        //get users using the same ip
        return DB::select("SELECT ip,

                                  (SELECT COUNT(DISTINCT (userid)) FROM ".$this->table("logs")." as slogs
                                   WHERE slogs.userip=logs.userip) as ipCount,

                                  (SELECT GROUP_CONCAT(DISTINCT(flogs.userid) ORDER BY flogs.userid SEPARATOR ',')
                                   FROM ".$this->table("logs")." as flogs
                                   WHERE flogs.userip=logs.userip) as ids_used

                          FROM ".$this->table("logs")." as logs
                          GROUP BY logs.userip HAVING ipCount>1");
    }

    private function table ($table)
    {
       return $this->app->dbTable([$table]);
    }

    private function postdata()
    {
       return $this->app->getvalidPostKey(json_decode($this->request->header("postdata"),1),['_token']);
    }

}
