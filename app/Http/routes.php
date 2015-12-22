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

Route::group(['prefix' =>''.ucfirst(config("app.admin_dirname")).'/','namespace'=>''.ucfirst(config("app.admin_dirname")).''], function () {

    Route::group(['namespace'=>'Login'], function ()
    {
        //home route (mainController)
        Route::get("login", "loginController@index");
    });

});