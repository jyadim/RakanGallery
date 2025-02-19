<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\NotificationController;
use App\Models\Album;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('guest.login');
});

// 🛑 Admin Routes (Hanya Admin)
Route::prefix('admin')->middleware('auth', 'admin')->group(function(){
    Route::get('dashboard', [AdminController::class, 'showPendingUsers'])->name('admin.dashboard');
    Route::post('dashboard/approve/{id}', [AdminController::class, 'approveUser'])->name('admin.approve-user');
    Route::post('dashboard/reject/{id}', [AdminController::class, 'rejectUser'])->name('admin.reject-user');
    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');

});

// 🙋‍♂️ User Routes
Route::prefix('user')->group(function () {
    // 🚪 Guest Routes
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'index'])->name('guest.login');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('guest.authenticate');
        Route::get('register', [LoginController::class, 'register'])->name('guest.register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('guest.processRegister');
    });

    // 🔒 Authenticated Users (Non-Admin)
    Route::middleware('auth')->group(function () {
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('album/{slug}', [AlbumController::class, 'index'])->name('detail.album');
        Route::get('photo/{slug}', [PhotoController::class, 'show'])->name('detail.photo');
        Route::post('photo/update/{id}', [PhotoController::class, 'update'])->name('photo.update');
        Route::delete('photo/delete/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy');
        Route::put('album/{id}', [AlbumController::class, 'update'])->name('album.update');
        Route::delete('album/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
        Route::post('notifications', [NotificationController::class, 'store']);
        Route::patch('notifications/{id}/read', [NotificationController::class, 'markAsRead']);
        Route::delete('/notifications/clear', [NotificationController::class, 'clearAll'])->name('notifications.clear');

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
