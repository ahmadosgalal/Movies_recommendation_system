<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!(Auth::guard('api')->check()) or $request->user()->role != 'Customer') {
            return response()->json(['message' => 'You are not an authenticated user'], 403);
        }
    }
}
