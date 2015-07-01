<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class ServerAccessOnly {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        // Log::info(print_r($_SERVER, 1));
        Log::info("Client IP: ". $request->getClientIp() );

        if ($request->getClientIp() == "127.0.0.1" || $request->getClientIp() == "162.144.107.232")
        {
            return $next($request);
        }
        else
        {
            Flash::error("401: Access Unauthorized.");
            return redirect('/');
        }

	}

}
