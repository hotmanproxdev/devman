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

      

      
      
      
      
      //dont delete this comment line


      //menus part
      Route::group(['namespace'=>'Menus'], function ()
      {
            //menus route (menusController)
            Route::controllers(['menus' => 'menusController']);
      });

            

      //managers part
      Route::group(['namespace'=>'Managers'], function ()
      {
            //managers route (managersController)
            Route::controllers(['managers' => 'managersController']);
      });

            

      //adminlog part
      Route::group(['namespace'=>'Adminlog'], function ()
      {
            //adminlog route (adminlogController)
            Route::controllers(['adminlog' => 'adminlogController']);
      });

            

      //notifications part
      Route::group(['namespace'=>'Notifications'], function ()
      {
            //notifications route (notificationsController)
            Route::controllers(['notifications' => 'notificationsController']);
      });


      //apicenter part
      Route::group(['namespace'=>'Apicenter'], function ()
      {
            //apicenter route (apicenterController)
            Route::controllers(['apicenter' => 'apicenterController']);
      });

            

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





    //logs part
    Route::group(['namespace'=>'Logs'], function ()
    {
        //test part
        Route::controllers(['logs' => 'logsController']);
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

Route::get("socialite/facebook","socialiteController@facebook");
Route::get("socialite/callback","socialiteController@callback");