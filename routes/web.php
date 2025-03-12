<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\SewaKamarController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PenghuniController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PengajuanSewaController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing-page');

// Middleware Guest - Hanya untuk user yang belum login
Route::middleware(['guest'])->group(function () {
    Route::get('/form-login', [AuthController::class, 'showLoginForm'])->name('form-login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

// Redirect setelah login
Route::get('/home', function () {
    return redirect('/');
})->name('home');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware Auth - Hanya untuk user yang sudah login
Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.admin');
});

Route::middleware(['auth', RoleMiddleware::class.':user'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('layouts.user');
    })->name('dashboard.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/pengajuan', [PemesananController::class, 'index'])->name('dashboard.pengajuan.index');
    Route::post('/admin/pengajuan/{id}/approve', [PemesananController::class, 'approve'])->name('dashboard.pengajuan.approve');
    Route::post('/admin/pengajuan/{id}/reject', [PemesananController::class, 'reject'])->name('dashboard.pengajuan.reject');
});

// Route Admin dengan RoleMiddleware
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tagihan', [TagihanController::class, 'indexAdmin'])->name('tagihan.index');
    Route::post('/tagihan', [TagihanController::class, 'store'])->name('tagihan.store');
    Route::put('/tagihan/{id}', [TagihanController::class, 'update'])->name('tagihan.update');
    Route::delete('/tagihan/{id}', [TagihanController::class, 'destroy'])->name('tagihan.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/tagihan/{id}/bayar', [PaymentController::class, 'pay'])->name('tagihan.pay');
    Route::post('/tagihan/checkout', [PaymentController::class, 'checkout'])->name('tagihan.checkout');
   // Rute callback Midtrans tanpa CSRF
});

Route::post('/payment/notification', [PaymentController::class, 'notificationHandler'])
->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/laporan/keuangan', [LaporanController::class, 'keuangan'])->name('laporan.keuangan');
Route::get('/laporan/keuangan/export-pdf', [LaporanController::class, 'exportPDF'])->name('laporan.keuangan.export-pdf');
Route::get('/laporan/keuangan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.keuangan.export-excel');

Route::middleware('auth')->group(function () {
    // Untuk user
    Route::get('/komplain/create', [KomplainController::class, 'create'])->name('komplain.create');
    Route::post('/komplain/store', [KomplainController::class, 'store'])->name('komplain.store');

    // Untuk admin
    Route::get('/admin/komplain', [KomplainController::class, 'index'])->name('komplain.index');
});

// Menu history untuk user
Route::middleware(['auth'])->group(function () {
    Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/data-diri', [DataDiriController::class, 'index'])->name('data-diri.index');
    Route::put('/data-diri/update', [DataDiriController::class, 'update'])->name('data-diri.update');
});

Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('dashboard.admin');

    Route::get('/admin/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
    // Routes umum yang memerlukan login
    Route::resource('kamar', KamarController::class);
    Route::get('/sewa-kamar', [SewaKamarController::class, 'index'])->name('sewa-kamar.index');
    // Route untuk halaman "Tentang Kami"
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.us');
    Route::get('/pemesanan/form/{id}', [PemesananController::class, 'showForm'])->name('pemesanan.form');
    Route::post('/pemesanan/store', [PemesananController::class, 'store'])->name('pemesanan.store');
    // Route::post('/pengajuan-sewa/store', [PemesananController::class, 'store'])->name('pengajuan-sewa.store');

