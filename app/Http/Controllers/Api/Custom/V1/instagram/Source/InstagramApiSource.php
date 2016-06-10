<?php

namespace App\Http\Controllers\Api\Custom\V1\instagram\Source;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Session;
use App\Http\Controllers\Api\ConfigApi as Config;
use App\Http\Controllers\Api\BaseApi as Base;


class InstagramApiSource extends Controller
{

    public $request;
    public $app;
    public $versionControl;
    public $config;
    public $env;
    public $base;

    public function __construct (Request $request,Config $config,Base $base)
    {
        //request class
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
        //get config
        $this->config=$config;
        //get environment
        $this->env=app("\Env")->system([__CLASS__,'Api']);
        //get base
        $this->base=$base;

    }

    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method Source İnstagram User İnfo
    |--------------------------------------------------------------------------
    |
    | Here is where you can register instagram user info of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function instagramEndpoints ($data=array())
    {
        /**
         * @param Api source token check
         * @throws return boolena
         */
        if($this->getInstagramUser()!==null)
        {
            /**
             * @param Api source guzzle
             * @throws return request json data
             */
            $request=$this->getEndpoint($data);

            //user service info return
            return json_decode($request->getBody()->getContents(),true);
        }

        //token null
        return [];

    }


    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method Source Guzzle Http
    |--------------------------------------------------------------------------
    |
    | Here is where you can take guzzle info of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getEndpoint ($data)
    {
        /**
         * @param Api source guzzle library
         * @throws return class object
         */
        $client = new \GuzzleHttp\Client();

        /**
         * @param Api source get instagram user
         * @throws return class object
         */
        $instagramUser=$this->getInstagramUser();

        //endpoint : users
        if($data['endpoint']==="users")
        {
            //guzzle get request data
            $request=$client->get("https://api.instagram.com/v1/users/self/?access_token=".$instagramUser->access_token);
        }

        //endpoint : media
        if($data['endpoint']==="media")
        {
            //guzzle get request data
            $request=$client->get("https://api.instagram.com/v1/users/".$instagramUser->id."/media/recent/?access_token=".$instagramUser->access_token);
        }

        return $request;


    }


    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method Source İnstagram Token
    |--------------------------------------------------------------------------
    |
    | Here is where you can register instagram token of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getInstagramUser ()
    {
       /**
       * @param Api source
       * @throws return array
       */
       return $this->getInstagramTokenFromDb(function ($data)
       {
            return (object)['access_token'=>$data['access_token'],'id'=>$data['id']];
       });

    }


    /*
    |--------------------------------------------------------------------------
    | Application Api Custom Get Method Source Get registered token
    |--------------------------------------------------------------------------
    |
    | Here is where you can take instagram registered token of the api for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the controller to call when that URI is requested.
    |
    */

    public function getInstagramTokenFromDb ($callback)
    {
        /**
         * @param Api source get user token
         * @throws return db result
         */

        $access_token='3177314012.2cc6bab.8f397c19e3174721a376fa20d61fc5a9';
        $id='3177314012';

        if(is_callable($callback))
        {
            return call_user_func_array($callback,[['access_token'=>$access_token,'id'=>$id]]);
        }

    }

}
