<?php

namespace App\Modules\Admin\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return redirect("admin/login");
            }else{
                // the token is valid and we have found the user via the sub claim
                return $next($request);
            }
        } catch (JWTException $e) {
            return redirect("admin/login");
        }
    }
}
