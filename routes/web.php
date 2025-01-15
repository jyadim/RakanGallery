<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return route('guest.login');
});
Route::prefix('user')->group(function () {
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('guest.login');
    Route::post('authenticate', [LoginController::class, 'authenticate'])->name('guest.authenticate');
    Route::get('register', [LoginController::class, 'register'])->name('guest.register');
    Route::post('process-register', [LoginController::class, 'processRegister'])->name('guest.processRegister');
});
Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [LoginController::class, 'logout'])->name('logout');

});
});