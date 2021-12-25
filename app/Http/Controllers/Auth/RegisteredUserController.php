<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return response()->json(['message' => 'this is the sign up form view']);
    
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator()->make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'manager_request' => 'boolean'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Something went wrong',$validator->getMessageBag()], 400);
        } else {
            $user = User::create([
                'username' => $request->username,
                'first-name' => $request->first_name,
                'last-name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'manager_request' => $request->manager_request,
            ]);

            $credentials = $request->only('username', 'password');
            $token = auth::attempt($credentials);
            return response()->json(['message' => 'Successfully created your account !','user'=>$request->user()->role,'AccessToken'=>$token], 201);
        }
    }
}
