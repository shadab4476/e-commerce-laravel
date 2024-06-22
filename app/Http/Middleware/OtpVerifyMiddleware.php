<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OtpVerifyMiddleware
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
        if (!session()->has('verify_otp_true')) {
            if (!session()->has('email_otp')) {
                return redirect()->back();
            }
            return redirect()->route('get.verifyOtp')->with(["error" => "Please enter your correct otp.."]);
        }
        return $next($request);
    }
}
