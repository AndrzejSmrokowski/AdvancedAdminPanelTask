<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', function () {
        return Inertia::render('UserLogin');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', function () {
        return Inertia::render('UserRegister');
    })->name('register');

    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'showDashboard'])->name('dashboard');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');
        Route::post('/', [PostController::class, 'store'])->name('post.store');
        Route::get('/create', function () {
            return Inertia::render('Posts/Create');
        })->name('posts.create');
        Route::get('/{id}', [PostController::class, 'show'])->name('post.detail');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('post.destroy');
        Route::put('/{id}', [PostController::class, 'update'])->name('post.update');
    });
});
