<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UserController;

// Login
Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');

// Register
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Dashboard
Route::get('/dashboard-anggota', [DashboardController::class, 'index'])->name('dashboard-anggota');

// Kolesi Buku
Route::get('/koleksi-buku', [BukuController::class, 'index'])->name('koleksi-buku');

// Peminjaman
Route::get('/peminjaman', function () {
    return "Halaman Peminjaman";
});

Route::get('/riwayat', function () {
    return "Halaman Riwayat";
});

Route::get('/logout', function () {
    return redirect('/');
});

// Pengembalian
Route::get('/pengembalian', [PengembalianController::class, 'pengembalian'])->name('pengembalian');
Route::post('/pengembalian/{id}', [PengembalianController::class, 'prosesKembali'])->name('proses-kembali');

// Detail Buku
Route::get('/buku/{id}', [BukuController::class, 'show'])->name('detail.buku');
Route::resource('user', UserController::class);