<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BeritaApiController;
use App\Http\Controllers\Api\LemariApiController;
use App\Http\Controllers\Api\PeminjamanApiController;

// Pastikan ini ada di awal file api.php
Route::middleware(['api'])->group(function () {
    
    // AUTH API - TANPA MIDDLEWARE
    Route::post('/login', [AuthApiController::class, 'login'])->name('api.login');
    Route::post('/register', [AuthApiController::class, 'register'])->name('api.register');
    
    // PROTECTED API ROUTES
    Route::middleware('auth:sanctum')->group(function () {
        
        // Auth routes
        Route::post('/logout', [AuthApiController::class, 'logout'])->name('api.logout');
        Route::get('/me', [AuthApiController::class, 'me'])->name('api.me');
        
        // Lemari routes - semua user bisa akses
        Route::apiResource('lemari', LemariApiController::class)->names([
            'index' => 'api.lemari.index',
            'show' => 'api.lemari.show',
            'store' => 'api.lemari.store',
            'update' => 'api.lemari.update',
            'destroy' => 'api.lemari.destroy'
        ]);
        
        // Peminjaman routes - user & admin
        Route::apiResource('peminjaman', PeminjamanApiController::class)
            ->only(['index', 'store', 'show']);
        
        // Berita routes - user & admin (read), admin (write)
        Route::apiResource('berita', BeritaApiController::class)
            ->only(['index', 'show']);
        
        // Admin only routes
        Route::middleware('role.api:admin')->group(function () {
            Route::apiResource('peminjaman', PeminjamanApiController::class)
                ->only(['update', 'destroy']);
            Route::apiResource('berita', BeritaApiController::class)
                ->only(['store', 'update', 'destroy']);
        });
    });
});