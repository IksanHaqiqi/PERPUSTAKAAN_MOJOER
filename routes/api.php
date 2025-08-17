<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BeritaApiController;
use App\Http\Controllers\Api\LemariApiController;
use App\Http\Controllers\Api\PeminjamanApiController;

// =====================
// AUTH API (Token-based)
// =====================
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/logout', [AuthApiController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/user', [AuthApiController::class, 'user'])->middleware('auth:sanctum');

// =====================
// ROUTE PROTECTED (HARUS LOGIN)
// =====================
Route::middleware('auth:sanctum')->group(function () {
    // Lemari CRUD full
    Route::apiResource('lemari', LemariApiController::class);

    // Routes untuk semua role (user & admin)
    Route::apiResource('peminjaman', PeminjamanApiController::class)->only(['index', 'store', 'show']);
    Route::apiResource('berita', BeritaApiController::class)->only(['index', 'store', 'show']);

    // Routes hanya untuk admin
    Route::middleware('role.api:admin')->group(function () {
        Route::apiResource('peminjaman', PeminjamanApiController::class)->only(['update', 'destroy']);
        Route::apiResource('berita', BeritaApiController::class)->only(['update', 'destroy']);
    });
});
