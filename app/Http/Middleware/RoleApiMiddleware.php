<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleApiMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user(); 

        if (! $user || $user->role !== $role) {
            return response()->json(['message' => 'kamu ga punya akses ke sini'], 403);
        }

        return $next($request);
    }
}
