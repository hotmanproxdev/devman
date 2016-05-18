<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Log;

class ApiModels extends Model
{
    protected $guarded = array('id');
    protected $table="prosystem_api_custom_models";

}
