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
            \DB::table("prosystem_log_statistics")->where("id","=",1)->increment("user",2);
            return true;
        });


        static::deleted(function()
        {
            \DB::table("prosystem_log_statistics")->where("id","=",1)->decrement("user",2);
            return true;
        });

    }



}
