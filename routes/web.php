<?php

use App\Http\Controllers\AuthController;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LemariController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;






Route::get('/', function () {
    return redirect('landing');
});
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.action');
});
// ...

Route::get('/landing', [LandingController::class, 'index'])->name('landing');
Route::middleware('auth')->group(function () {
    
    Route::get('/lemari', [LemariController::class, 'index'])->name('crud.index');
    Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    Route::get('/peminjaman/cetak-pdf', [PeminjamanController::class, 'cetakPDF'])->name('peminjaman.pdf');


    Route::middleware('role:user')->group(function () {
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::get('/peminjaman/create/{lemari_id}', [PeminjamanController::class, 'create'])->name('peminjaman.create');
        Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/lemari/create', [LemariController::class, 'create'])->name('crud.create');
        Route::post('/lemari', [LemariController::class, 'store'])->name('crud.store');
        Route::get('/lemari/{id}/edit', [LemariController::class, 'edit'])->name('crud.edit');
        Route::put('/lemari/{id}', [LemariController::class, 'update'])->name('crud.update');
        Route::delete('/lemari/{id}', [LemariController::class, 'destroy'])->name('crud.destroy');
        Route::get('/peminjaman/status', [PeminjamanController::class, 'adminIndex'])->name('peminjaman.status');
        Route::post('/peminjaman/{id}/status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
        Route::get('/chart', [ChartController::class, 'index'])->name('chart.index');
    });
});
