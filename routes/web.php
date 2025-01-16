<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;



// Default route to redirect to the login page
Route::get('/', function () {
    return redirect()->route('guest.login'); // Redirect to login page
});

// User routes (login, register, etc.)
Route::prefix('user')->group(function () {
    // Guest-only routes (login, register)
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('guest.login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('guest.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('guest.register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('guest.processRegister');
    });

    // Authenticated routes (dashboard, logout)
    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard'); // Corrected to point to dashboard method
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    });
});
