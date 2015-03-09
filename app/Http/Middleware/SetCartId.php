<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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

        if (!Session::has('unique_id')) {
            // check cookie
            $unique_id = Cookie::get('unique_id');
            if ($unique_id)
                Session::put('unique_id', $unique_id);
            else
            {
                $unique_id = uniqid("beta64", true);
                Session::put('unique_id', $unique_id);
                Cookie::queue('unique_id', $unique_id, 100000);
            }
        }
        // dd(Session::get('unique_id'));
		return $next($request);
	}

}
