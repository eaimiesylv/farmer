<?php

use App\Http\Controllers\Core\Auth\User\LoginController;

Route::get('login', [LoginController::class, 'show'])
    ->name('users.login.index');

Route::post('login', [LoginController::class, 'login'])
    ->name('users.login');
	
Route::get('register', [LoginController::class, 'show'])
    ->name('users.login.register');

Route::get('verify/{email}', [LoginController::class, 'verify'])
    ->name('users.login.verify');

Route::get('/verification', function () {
        return view('auth.verification');
    })->name('verification');
    

#http://localhost:8000/admin/users/password-reset//router
#http://localhost:8000/users/password-reset
#http://localhost:8000/users/password-reset