<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Larabros\Elogram\Client as Client;

class instagramController extends Controller
{

    public $request;
    private $instagramClientId='2cc6bab5c386499e983090b0fa69c927';
    private $instagramClientSecret='2032d51fc73345de920e73c237b76d7e';
    private $instagramRedirectUrl='http://localhost:8070/projects/devman/devman/public/socialite/services/instagram/token';

    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    /**
     * Store a token resource in instagram.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getToken()
    {
        session_start();
        $client = new \GuzzleHttp\Client();

        if(!array_key_exists("code",\Input::all()))
        {
            $clientCheck = new Client($this->instagramClientId, $this->instagramClientSecret, null, $this->instagramRedirectUrl);

            $login=str_replace('scope=basic',"scope=basic+follower_list+public_content+comments+relationships+likes",$clientCheck->getLoginUrl());
            return redirect($login);
        }

        $response = $client->post('https://api.instagram.com/oauth/access_token', array('form_params' => array(
            'client_id' => $this->instagramClientId,
            'client_secret' => $this->instagramClientSecret,
            'grant_type' => 'authorization_code',
            'redirect_uri' =>$this->instagramRedirectUrl,
            'code' => \Input::get("code")
        )));

        return $response->getBody()->getContents();
    }

}
