<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyCode
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard()->check()) {  // if the user is authenticated
            if (Auth::user()->email_verified_at == null) {  // if the email is not verified
                return redirect('/verify');  // redirect to the verification route
            }
        }

        return $next($request);
    }
}
