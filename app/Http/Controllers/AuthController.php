<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, redirect sesuai role
        if (Auth::check()) {
            return redirect()->route('crud.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Buat token untuk API
            $token = $user->createToken('web_token')->plainTextToken;
            $request->session()->put('api_token', $token);

            // Jika request via AJAX/fetch, kembalikan JSON
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Login berhasil',
                    'access_token' => $token,
                    'user' => $user
                ]);
            }

            // Redirect normal ke dashboard /lemari
            return redirect()->route('crud.index');
        }

        // Login gagal
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Email atau password salah'], 401);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('crud.index')
                : redirect()->route('landing');
        }
        
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);

        Auth::login($user);

        // Buat token API
        $token = $user->createToken('web_token')->plainTextToken;
        $request->session()->put('api_token', $token);

        return redirect()->route('crud.index');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            // Hapus token web
            $user->tokens()->where('name','web_token')->delete();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
