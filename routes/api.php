<?php

use App\Http\Controllers\Api\BeritaApiController;
use App\Http\Controllers\Api\LemariApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// =====================
// LOGIN API (Token-based)
// =====================
Route::post('/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

// =====================
// ROUTE PROTECTED (HARUS LOGIN)
// =====================
Route::middleware('auth:sanctum')->group(function () {

    // Logout
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    });

    // Data user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // =====================
    // Routes untuk semua role (user & admin)
    // =====================
    Route::apiResource('peminjaman', PeminjamanApiController::class)->only(['index', 'store', 'show']);
    Route::apiResource('berita', BeritaApiController::class)->only(['index', 'store', 'show']);

    // =====================
    // Routes hanya untuk admin
    // =====================
    Route::middleware('role.api:admin')->group(function () {
        Route::apiResource('lemari', LemariApiController::class);
        Route::apiResource('peminjaman', PeminjamanApiController::class)->only(['update', 'destroy']);
        Route::apiResource('berita', BeritaApiController::class)->only(['update', 'destroy']);
    });
});
