<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Menu extends Model
{
    protected $guarded = array('id');
    protected $table="prosystem_admin_menus";

    public static function boot()
    {
        parent::boot();

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
