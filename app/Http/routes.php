<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' =>''.config("app.admin_dirname").'/','namespace'=>''.config("app.admin_dirname").''], function () {

   Route::get("test",function() { return 'test'; });

});