<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        if (! auth()->user()->is_verified) {
            return redirect()->route('verification.notice')
                ->with('warning', 'Please verify your account to access this feature.');
        }

        return $next($request);
    }
}
