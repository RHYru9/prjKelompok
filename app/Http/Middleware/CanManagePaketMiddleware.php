<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanManagePaketMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isDriver())) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Unauthorized access. Admin or Driver role required.');
    }
}
