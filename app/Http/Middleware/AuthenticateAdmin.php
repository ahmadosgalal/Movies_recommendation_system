<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
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
        if (!(Auth::guard('admin-api')->check()) || $request->user()->role != 'Admin') {
            return response()->json(['message' => 'You are not an authenticated admin'], 403);
        }
    return $next($request);
    }
}
