<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Martin\Products\CartRepository;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array   $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        $this->setupLayout();

        $response = call_user_func_array(array($this, $method), $parameters);

        // If no response is returned from the controller action and a layout is being
        // used we will assume we want to just return the layout view as any nested
        // views were probably bound on this view during this controller actions.
        if (is_null($response) && ! is_null($this->layout))
        {
            $response = $this->layout;
        }

        return $response;
    }


    protected function setupLayout()
    {
        /*if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
        }*/

        view()->share('currentUser', Auth::user());

        $cartRepo = new CartRepository();
        //dd($cartRepo);

        view()->share('cartRepo', $cartRepo);

        view()->share('cartTotal', $cartRepo->getCartTotal());
        view()->share('cartData', $cartRepo->getCartData());

        // View::share('cartNumItems', $cartRepo->getCartNumItems($userCart));
    }
}
