<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\CariKamarController;

// Landing Page (Home)
Route::get('/', function () {
    return view('landing.home');
})->name('home');

// About
Route::get('/about', function () {
    return view('landing.about');
})->name('about');

// Services
Route::get('/services', function () {
    return view('landing.services');
})->name('services');

// Contact
Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');

// Auth process
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (protected)
Route::aliasMiddleware('role', RoleMiddleware::class);
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->get('/user/dashboard', function () {
    return view('user.dashboard');
});

// kamar
Route::middleware(['auth', RoleMiddleware::class.':admin'])->prefix('admin')->group(function () {
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::post('/kamar', [KamarController::class, 'store'])->name('kamar.store');
    Route::put('/kamar/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
});

Route::get('/cari-kamar', function () {
    return view('cari-kamar');
});


Route::get('/cari-kamar', [CariKamarController::class, 'index'])->name('cari-kamar');



