<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return response()->json(['message' => 'this is the login form page']);
    
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data','Errors in'=>$validator->getMessageBag()], 400);
        } else {
            $credentials = $request->only('username', 'password');
            $token = Auth::attempt($credentials, true);
            if ($token){
                return response()->json(['message' => 'logged in successfully','role'=>$request->user()->role,'AccessToken:'=>$token], 200);
            }
            else{
                return response()->json(['message' => 'No such user, invalid email or password'], 400);
            }
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
     auth::logout() ;
        return response()->json(['message' => 'logged out successfully'], 200);
     
    }
}
