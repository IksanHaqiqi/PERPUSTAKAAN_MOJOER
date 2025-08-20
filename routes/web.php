<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LemariController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;



// Landing page (accessible to all)

// Guest only routes (redirect if already authenticated)
Route::middleware('guest')->group(function () {
    Route::get('/landing', [LandingController::class, 'index'])->name('landing');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.action');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.action');
});

// Authenticated web routes (SESSION-based, NOT for API)
Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/', function () { return redirect('/lemari'); });
    
    // Common authenticated routes
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/profil', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profil', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Routes accessible by all authenticated users
    Route::get('/lemari', [LemariController::class, 'index'])->name('crud.index');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::get('/peminjaman/cetak-pdf', [PeminjamanController::class, 'cetakPDF'])->name('peminjaman.pdf');
    
    // User role specific routes
    Route::middleware('role:user')->group(function () {
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/peminjaman/create/{lemari_id}', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });
    
    // Admin role specific routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/lemari/create', [LemariController::class, 'create'])->name('crud.create');
        Route::post('/lemari', [LemariController::class, 'store'])->name('crud.store');
        Route::get('/lemari/{id}/edit', [LemariController::class, 'edit'])->name('crud.edit');
        Route::put('/lemari/{id}', [LemariController::class, 'update'])->name('crud.update');
        Route::delete('/lemari/{id}', [LemariController::class, 'destroy'])->name('crud.destroy');
        Route::get('/peminjaman/status', [PeminjamanController::class, 'adminIndex'])->name('peminjaman.status');
        Route::get('/berita/status', [BeritaController::class, 'adminIndex'])->name('berita.status');
        Route::post('/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
        Route::get('/chart', [ChartController::class, 'index'])->name('chart.index');
        Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
        Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
    });
});
