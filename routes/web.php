<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\Admin\AdminController;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;

// Default route to redirect to the login page
Route::get('/', function () {
    return redirect()->route('guest.login'); // Redirect to login page
});

// User routes (login, register, etc.)

Route::prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('pending-users', [AdminController::class, 'showPendingUsers'])->name('admin.pending-users');
    Route::post('approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approve-user');
    Route::post('reject-user/{id}', [AdminController::class, 'rejectUser'])->name('admin.reject-user');
});
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
        Route::get('album/{slug}', [AlbumController::class, 'index'])->name('detail.album');
        Route::get('Photo/{slug}', [PhotoController::class, 'show'])->name('detail.photo');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('album/{slug}/UploadPhoto', [AlbumController::class, 'upload'])->name('photo.store');
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('edit/profile', [ProfileController::class, 'edit'])->name('edit.profile');
        Route::post('edit/profile/proccess', [ProfileController::class, 'edit_proccess'])->name('edit.profile.proccess');
        Route::post('create/albums', [ProfileController::class, 'create_album'])->name('create.album');
        Route::post('posts/comments', [PhotoController::class, 'store_comments'])->name('store.comments');
        Route::post('posts/like/{id}', [PhotoController::class, 'like'])->name('photo.like');

    });
});
