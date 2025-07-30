<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class ValidasiRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika role tidak sesuai, redirect ke halaman daftar buku
        if (Auth::user()->role !== $role) {
            return redirect()->route('crud.index')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}