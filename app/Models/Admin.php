<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Admin extends Model
{
    protected $guarded = array('id');
    protected $hidden=array("password");
    protected $table="prosystem_administrator";
    //protected $dates = ['deleted_at'];

    public static function boot()
    {
        //parent::boot();

        static::created(function()
        {
            return \DB::table("prosystem_log_statistics")->where("id","=",1)->increment("user",1);
        });


        static::deleted(function()
        {
            return \DB::table("prosystem_log_statistics")->where("id","=",1)->decrement("user",1);
        });

    }



}
