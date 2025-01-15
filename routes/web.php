<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return view('welcome');
})->middleware(UserMiddleware::class);
Route::get('login', function (){
    return view('loginpage');

});