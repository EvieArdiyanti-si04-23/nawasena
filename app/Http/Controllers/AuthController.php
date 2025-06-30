<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('pelanggan.dashboard');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function dashboard() {
        if (Auth::check() && Auth::user()->role === 'pelanggan') {
            return view('pelanggan.dashboard');
        }

        return abort(403, 'Akses Ditolak');
        }

    public function showRegister()
    {
        return view('auth.register'); // Pastikan file ini ada: resources/views/auth/register.blade.php
    }

    public function register(Request $request)
    {
        // Validasi data form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pelanggan' // default role pelanggan
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke dashboard pelanggan
        return redirect()->route('pelanggan.dashboard');
    }

    public function logout(Request $request)
    {
        \Auth::logout(); // atau Auth::logout(); jika sudah di-import di atas

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
