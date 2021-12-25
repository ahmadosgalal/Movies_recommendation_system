<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\UsersController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;




// guest routes do not need any authentication
Route::group(['middleware' => ['guest','cors']], function(){

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

});


// customer routes
Route::group(['middleware' => ['auth','cors']], function(){

   Route::post('/movie/{id}/book', [ReservationsController::class, 'store'])
    ->name('Add Reservation');

   Route::get('/bookings', [ReservationsController::class, 'index'])
    ->name('Get All reservations');

    Route::delete('/bookings/{id}', [ReservationsController::class, 'destroy'])
    ->name('Get All reservations');

   Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
   
 });

 //manager routes
 Route::group(['middleware' => ['auth-manager','cors']], function(){
    Route::post('manager/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
   
    Route::get('/addmovie', [MoviesController::class, 'create'])
    ->name('add movie form');

    Route::post('/movie', [MoviesController::class, 'store'])
    ->name('add movie');

    Route::get('/movie/{id}/edit', [MoviesController::class, 'edit'])
    ->name('edit movie');

    Route::get('/movie/{id}/seats', [MoviesController::class, 'seats'])
    ->name('get seats');

    Route::put('/movie/{id}', [MoviesController::class, 'update'])
    ->name('update movie');

    

 });

 // admin routes
Route::group(['middleware' => ['auth-admin','cors']], function(){
    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::delete('/user/{id}', [UsersController::class, 'destroy'])
    ->name('removeuser');

    Route::get('/approve', [UsersController::class, 'index'])
    ->name('show requests');

    Route::patch('/user/{id}', [UsersController::class, 'update'])
    ->name('respond to requests');

 });