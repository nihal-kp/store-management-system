<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
        $response = $next($request);
        
        if (Auth::guard($guard)->check()) {
            if ($guard == 'customer' && Auth::guard($guard)->user()->otp_verification_status == 1) {
                
                if (Auth::guard($guard)->user()->verification_status != 1) {
                    Auth::guard($guard)->logout();
                    return response()->json([
                        'csrf' => csrf_token(),
                        'errors' => ['email'=>'Your account is under verification. Please contact Administrator'],
                    ],422);
                }
                
                elseif (Auth::guard($guard)->user()->status != 1) {
                    Auth::guard($guard)->logout();
                    return response()->json([
                        'csrf' => csrf_token(),
                        'errors' => ['email'=>'Your account has been disabled. Please contact Administrator'],
                    ],422);
                }
            }
            elseif ($guard == 'customer' && Auth::guard($guard)->user()->otp_verification_status == 0) {
                Auth::guard($guard)->logout();
            }


            if ($guard == 'admin' && Auth::guard($guard)->user()->status != 1) {
                Auth::guard($guard)->logout();

                // Session::flash('msg', 'Your account has been disabled by Administrator. Please contact Administrator');

                // response();
                return Redirect::back()->withErrors(['email' => 'Your account has been disabled. Please contact Administrator']);
            }
        }
        
        return $response;
    }
}
