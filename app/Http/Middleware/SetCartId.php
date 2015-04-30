<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class SetCartId {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        if (!session()->has('unique_id')) {

            // check cookie
            $unique_id = Cookie::get('unique_id');
            if (! $unique_id)
            {
                $unique_id = uniqid("beta64", true);
                Cookie::queue('unique_id', $unique_id, 100000);
            }

            session(['unique_id' => $unique_id]);

            // set cart to be refreshed
            session(['refreshCart' => true]);
        }
        // dd(Session::get('unique_id'));
		return $next($request);
	}

}
