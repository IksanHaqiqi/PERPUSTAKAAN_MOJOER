<?php
// 1. PASTIKAN MIDDLEWARE role.api ADA DAN BENAR
// File: app/Http/Middleware/RoleApiMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleApiMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
        
        if ($user->role !== $role) {
            return response()->json([
                'status' => false,
                'message' => 'Forbidden - Insufficient permissions'
            ], 403);
        }
        
        return $next($request);
    }
}