<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;




// guest routes do not need any authentication
Route::group(['middleware' => 'guest'], function(){

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

});


// customer routes
Route::group(['middleware' => 'auth'], function(){

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
 });

 //manager routes
 Route::group(['middleware' => 'auth-manager'], function(){
    Route::post('manager/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

 });

 // admin routes
Route::group(['middleware' => 'auth-admin'], function(){
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

 });