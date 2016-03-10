<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;

class Profile extends Model
{
    protected $table="prosystem_administrator";

    public static function boot()
    {
        parent::boot();

        static::saving(function(Profile $model)
        {
            foreach($model->getDirty() as $attribute => $value){
                $original= $model->getOriginal($attribute);
                Log::info("Changed ".$attribute." from ".$original."to ".$value."<br/>\r\n");
            }
            return true; //if false the model wont save!
        });
    }
}
