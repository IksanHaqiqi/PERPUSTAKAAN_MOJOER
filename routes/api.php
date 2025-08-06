<?php

use App\Http\Controllers\Api\BeritaApiController;
use App\Http\Controllers\Api\LemariApiController;
use App\Http\Controllers\Api\PeminjamanApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


// LOGIN
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

// PROTECTED ROUTES - HARUS LOGIN
// Logout
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout berhasil']);
    });

    // Data user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Public for both roles
    Route::get('/user', fn(Request $request) => $request->user());
    Route::apiResource('peminjaman', PeminjamanApiController::class)->only(['index', 'store', 'show']);
    Route::apiResource('berita', BeritaApiController::class)->only(['index', 'store', 'show']);

    // Role admin only
    Route::middleware('role.api:admin')->group(function () {
        Route::apiResource('lemari', LemariApiController::class);
        Route::apiResource('peminjaman', PeminjamanApiController::class)->only(['update', 'destroy']);
        Route::apiResource('berita', BeritaApiController::class)->only(['update', 'destroy']);
    });
});
