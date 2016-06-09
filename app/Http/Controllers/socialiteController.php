<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Larabros\Elogram\Client as Client;

class socialiteController extends Controller
{

    public $request;
    private $instagramClientId='2cc6bab5c386499e983090b0fa69c927';
    private $instagramClientSecret='2032d51fc73345de920e73c237b76d7e';
    private $instagramRedirectUrl='http://localhost:8070/projects/devman/devman/public/socialite/instagram?this=that';

    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function facebook()
    {
        return \Socialite::with('facebook')->redirect();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callback()
    {
        $user=\Socialite::with('facebook')->user();
        return $user;
    }

    /**
     * Store a newly created resource in instagram.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function instagram()
    {
        session_start();
        $client = new \GuzzleHttp\Client();

        if(!array_key_exists("code",\Input::all()))
        {
            $clientCheck = new Client($this->instagramClientId, $this->instagramClientSecret, null, $this->instagramRedirectUrl);

            return redirect($clientCheck->getLoginUrl());
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
