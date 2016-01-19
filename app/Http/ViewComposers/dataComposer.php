<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class dataComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $request;

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
    }

}