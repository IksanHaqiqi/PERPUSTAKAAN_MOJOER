<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Hanya berlaku untuk API routes
        if (!$request->is('api/*')) {
            return $next($request);
        }

        // Untuk API, gunakan Sanctum
        if (!$request->user('sanctum')) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized - Token required'
            ], 401);
        }

        return $next($request);
    }
}