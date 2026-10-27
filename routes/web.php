<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', [FeedController::class, 'index'])->name('feed');
Route::get('/switch-user/{username}', [AuthController::class, 'demoSwitch'])->name('demo.switch');

Route::middleware('auth')->group(function () {
    Route::post('/posts', [FeedController::class, 'storePost'])->name('posts.store');
    Route::post('/posts/{post}/like', [FeedController::class, 'toggleLike'])->name('posts.like');
    Route::post('/posts/{post}/comments', [FeedController::class, 'storeComment'])->name('comments.store');
    Route::post('/users/{user}/follow', [FeedController::class, 'toggleFollow'])->name('users.follow');

    // CMS & Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::delete('/admin/posts/{post}', [AdminController::class, 'deletePost'])->name('admin.posts.delete');
    Route::post('/admin/users/{user}/verify', [AdminController::class, 'toggleVerify'])->name('admin.users.verify');
});
