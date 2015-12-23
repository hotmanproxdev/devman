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

Route::group(['prefix' =>''.strtolower(config("app.admin_dirname")).'/','namespace'=>''.config("app.admin_dirname").''], function () {

    //login part
    Route::group(['namespace'=>'Login'], function ()
    {
        //login route (mainController)
        Route::controllers(['login' => 'loginController']);
    });

    //logout part
    Route::get("logout", "logoutController@index");


    //home part
    Route::group(['namespace'=>'Home'], function ()
    {
        //login route (mainController)
        Route::get("home", "homeController@index");
    });

});