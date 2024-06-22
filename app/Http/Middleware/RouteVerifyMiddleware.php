<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RouteVerifyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has("verify_otp_true")) {
            return $next($request);
        }
        return redirect()->back();
    }
}
