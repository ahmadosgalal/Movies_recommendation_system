<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateManager
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
        if (!(Auth::guard('manager-api')->check()) or $request->user()->role != 'Manager') {
            return response()->json(['message' => 'You are not an authenticated manager'], 403);
        }
    return $next($request);
    }
}
