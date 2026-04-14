<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\anggota\BukuController as AnggotaBukuController;
use App\Http\Controllers\anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\anggota\PeminjamanController as AnggotaPeminjamanController;
use App\Http\Controllers\anggota\PengembalianController as AnggotaPengembalianController;
use App\Http\Controllers\kepala_perpustakaan\DashboardController as KepalaDashboardController;
use App\Http\Controllers\kepala_perpustakaan\PetugasController;
use App\Http\Controllers\kepala_perpustakaan\ReportController;
use App\Http\Controllers\petugas\BookController as PetugasBookController;
use App\Http\Controllers\petugas\CategoryController;
use App\Http\Controllers\petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\petugas\LoanApprovalController;
use App\Http\Controllers\petugas\MemberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'login'])->name('login');

// Test route - jika ini bisa diakses, server OK
Route::get('/test', function () {
    return 'Server berjalan baik';
});

Route::middleware('guest')->group(function () {
    Route::post('/login', [LoginController::class, 'prosesLogin'])->name('login.proses');

    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/koleksi-buku', [AnggotaBukuController::class, 'index'])->name('books.index');
    Route::get('/buku/{book}', [AnggotaBukuController::class, 'show'])->name('books.show');
    Route::post('/buku/{book}/pinjam', [AnggotaPeminjamanController::class, 'store'])->name('borrow.store');
    Route::get('/peminjaman', [AnggotaPeminjamanController::class, 'index'])->name('borrow.index');
    Route::get('/pengembalian', [AnggotaPengembalianController::class, 'index'])->name('returns.index');
    Route::post('/pengembalian/{peminjaman}', [AnggotaPengembalianController::class, 'store'])->name('returns.store');
});

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('dashboard');
    Route::get('/koleksi-buku', [PetugasBookController::class, 'index'])->name('books.index');
    Route::get('/koleksi-buku/tambah', [PetugasBookController::class, 'create'])->name('books.create');
    Route::post('/koleksi-buku', [PetugasBookController::class, 'store'])->name('books.store');
    Route::get('/koleksi-buku/{book}', [PetugasBookController::class, 'show'])->name('books.show');
    Route::get('/koleksi-buku/{book}/edit', [PetugasBookController::class, 'edit'])->name('books.edit');
    Route::post('/koleksi-buku/{book}', [PetugasBookController::class, 'update'])->name('books.update');
    Route::delete('/koleksi-buku/{book}', [PetugasBookController::class, 'destroy'])->name('books.destroy');

    Route::get('/kategori', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('categories.store');
    Route::post('/kategori/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/kategori/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/peminjaman', [LoanApprovalController::class, 'borrowIndex'])->name('borrow.index');
    Route::post('/peminjaman/{peminjaman}/setujui', [LoanApprovalController::class, 'approveBorrow'])->name('borrow.approve');
    Route::post('/peminjaman/{peminjaman}/tolak', [LoanApprovalController::class, 'rejectBorrow'])->name('borrow.reject');

    Route::get('/pengembalian', [LoanApprovalController::class, 'returnIndex'])->name('returns.index');
    Route::post('/pengembalian/{peminjaman}/setujui', [LoanApprovalController::class, 'approveReturn'])->name('returns.approve');
    Route::post('/pengembalian/{peminjaman}/tolak', [LoanApprovalController::class, 'rejectReturn'])->name('returns.reject');

    Route::get('/anggota', [MemberController::class, 'index'])->name('members.index');
});

Route::middleware(['auth', 'role:kepala_perpustakaan'])->prefix('kepala-perpustakaan')->name('kepala.')->group(function () {
    Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('dashboard');

    Route::get('/koleksi-buku', [PetugasBookController::class, 'index'])->defaults('panel', 'kepala')->name('books.index');
    Route::get('/koleksi-buku/{book}', [PetugasBookController::class, 'show'])->defaults('panel', 'kepala')->name('books.show');
    Route::get('/kategori', [CategoryController::class, 'index'])->defaults('panel', 'kepala')->name('categories.index');

    Route::get('/peminjaman', [LoanApprovalController::class, 'borrowIndex'])->name('borrow.index');
    Route::post('/peminjaman/{peminjaman}/setujui', [LoanApprovalController::class, 'approveBorrow'])->name('borrow.approve');
    Route::post('/peminjaman/{peminjaman}/tolak', [LoanApprovalController::class, 'rejectBorrow'])->name('borrow.reject');
    Route::get('/pengembalian', [LoanApprovalController::class, 'returnIndex'])->name('returns.index');
    Route::post('/pengembalian/{peminjaman}/setujui', [LoanApprovalController::class, 'approveReturn'])->name('returns.approve');
    Route::post('/pengembalian/{peminjaman}/tolak', [LoanApprovalController::class, 'rejectReturn'])->name('returns.reject');
    Route::get('/anggota', [MemberController::class, 'index'])->defaults('panel', 'kepala')->name('members.index');
    Route::get('/petugas', [PetugasController::class, 'index'])->name('staff.index');
    Route::post('/petugas', [PetugasController::class, 'store'])->name('staff.store');
    Route::get('/laporan', [ReportController::class, 'index'])->name('reports.index');
});
