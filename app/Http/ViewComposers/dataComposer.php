<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Session;

class dataComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $request;
    protected $token;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(Request $request)
    {
        // Dependencies automatically resolved by service container...
        $this->request = $request;
        $this->token=config("app.token");

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('baseUrl', 'http://'.$this->request->getHttpHost().''.$this->request->getBaseUrl().'');
        $view->with('mandev', 'http://'.$this->request->getHttpHost().''.$this->request->getBaseUrl().'/'.strtolower(config("app.admin_dirname")).'');
        $view->with('token',$this->token);
    }

}