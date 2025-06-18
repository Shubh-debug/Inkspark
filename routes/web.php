<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AuthController;

// Redirect root to blog index
Route::get('/', function () {
    return redirect()->route('blogs.index');
});

// Blog Routes (protected after login)
Route::middleware('auth')->group(function () {
    Route::resource('blogs', BlogController::class);
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/recycle-bin', [BlogController::class, 'recycleBin'])->name('blogs.recycle-bin');
    Route::get('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');
    Route::get('/blogs/{id}/force-delete', [BlogController::class, 'forceDelete'])->name('blogs.force-delete');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth Routes (public)
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
?>
