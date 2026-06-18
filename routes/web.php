<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Masyarakat\PengaduanController as MasyarakatPengaduanController;
use App\Http\Controllers\Petugas\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// ===== Halaman utama =====
Route::get('/', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin'      => redirect('/admin/dashboard'),
            'petugas'    => redirect('/petugas/dashboard'),
            'masyarakat' => redirect('/masyarakat/dashboard'),
            default      => redirect('/login'),
        };
    }
    return redirect('/login');
});

// ===== Auth =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===== Masyarakat =====
Route::prefix('masyarakat')->middleware(['auth', 'role:masyarakat'])->group(function () {
    Route::get('/dashboard', [MasyarakatPengaduanController::class, 'dashboard'])->name('masyarakat.dashboard');
    Route::get('/pengaduan', [MasyarakatPengaduanController::class, 'index'])->name('masyarakat.pengaduan.index');
    Route::get('/pengaduan/buat', [MasyarakatPengaduanController::class, 'create'])->name('masyarakat.pengaduan.create');
    Route::post('/pengaduan', [MasyarakatPengaduanController::class, 'store'])->name('masyarakat.pengaduan.store');
    Route::get('/pengaduan/{id}', [MasyarakatPengaduanController::class, 'show'])->name('masyarakat.pengaduan.show');
});

// ===== Petugas =====
Route::prefix('petugas')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/dashboard', [PetugasPengaduanController::class, 'dashboard'])->name('petugas.dashboard');
    Route::get('/pengaduan', [PetugasPengaduanController::class, 'index'])->name('petugas.pengaduan.index');
    Route::get('/pengaduan/{id}', [PetugasPengaduanController::class, 'show'])->name('petugas.pengaduan.show');
    Route::post('/pengaduan/{id}/tanggapi', [PetugasPengaduanController::class, 'tanggapi'])->name('petugas.tanggapi');
    Route::patch('/pengaduan/{id}/status', [PetugasPengaduanController::class, 'updateStatus'])->name('petugas.status');
});

// ===== Admin =====
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Pengaduan
    Route::get('/pengaduan', [AdminController::class, 'pengaduanIndex'])->name('admin.pengaduan.index');
    Route::get('/pengaduan/{id}', [AdminController::class, 'pengaduanShow'])->name('admin.pengaduan.show');
    Route::patch('/pengaduan/{id}/status', [AdminController::class, 'pengaduanUpdateStatus'])->name('admin.pengaduan.status');
    Route::delete('/pengaduan/{id}', [AdminController::class, 'pengaduanDestroy'])->name('admin.pengaduan.destroy');

    // Petugas
    Route::get('/petugas', [AdminController::class, 'petugasIndex'])->name('admin.petugas.index');
    Route::get('/petugas/tambah', [AdminController::class, 'petugasCreate'])->name('admin.petugas.create');
    Route::post('/petugas', [AdminController::class, 'petugasStore'])->name('admin.petugas.store');
    Route::delete('/petugas/{id}', [AdminController::class, 'petugasDestroy'])->name('admin.petugas.destroy');

    // Kategori
    Route::get('/kategori', [AdminController::class, 'kategoriIndex'])->name('admin.kategori.index');
    Route::post('/kategori', [AdminController::class, 'kategoriStore'])->name('admin.kategori.store');
    Route::delete('/kategori/{id}', [AdminController::class, 'kategoriDestroy'])->name('admin.kategori.destroy');

    // Masyarakat
    Route::get('/masyarakat', [AdminController::class, 'masyarakatIndex'])->name('admin.masyarakat.index');
});