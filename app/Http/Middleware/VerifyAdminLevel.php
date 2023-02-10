<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAdminLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset(Auth::user()->admin_level) && Auth::user()->admin_level >= 999)
            return $next($request);

        Auth::logout();
        return redirect()->route("login");
    }
}
