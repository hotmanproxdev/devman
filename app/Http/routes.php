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
        //login route (loginController)
        Route::controllers(['login' => 'loginController']);
    });


    //profile part
    Route::group(['namespace'=>'Profile'], function ()
    {
        //test part
        Route::controllers(['profile/{id?}' => 'profileController']);
    });

    //users part
    Route::group(['namespace'=>'Users'], function ()
    {
        //test part
        Route::controllers(['users' => 'usersController']);
    });


    //api part
    Route::group(['namespace'=>'Api'], function ()
    {
        //test part
        Route::controllers(['api' => 'apiController']);
    });


    //test part
    Route::group(['namespace'=>'Test'], function ()
    {
        //test part
        Route::controllers(['test' => 'testController']);
    });


    //lockScreen part
    Route::group(['namespace'=>'LockScreen'], function ()
    {
        //login route (loginController)
        Route::controllers(['lockscreen' => 'lockScreenController']);
    });

    //logout part
    Route::get("logout", "logoutController@index");




    //home part
    Route::group(['namespace'=>'Home'], function ()
    {
        //home route (homeController)
        Route::get("home", "homeController@index");
    });



});


Route::group(['prefix' =>'api/','namespace'=>'Api'], function () {

    //api connection (http/api request)
    Route::any("connect/{ccode}/{apikey}", "ConnectionApi@index");

    //api services (http/api/services request)
    Route::any("services/{serviceName}", "ServicesApi@index");

});


Route::get("/test","testController@index");