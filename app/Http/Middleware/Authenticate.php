<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
               $req_uri = $_SERVER['REQUEST_URI'];//substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], $_SERVER['SCRIPT_FILENAME']));
             //echo $req_uri;
                
             if($req_uri!="/" && strpos($req_uri, "/cart") !== false) 
               return redirect()->guest('login');
            }
        }

        return $next($request);
    }
}
