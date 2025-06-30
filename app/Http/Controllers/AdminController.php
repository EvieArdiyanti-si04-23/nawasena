<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('admin.login'); // resources/views/admin/login.blade.php
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan admin.']);
            }
        }

        return back()->withErrors(['email' => 'Login gagal.']);
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalMenu' => \App\Models\Menu::count(),
            'totalPelanggan' => \App\Models\User::where('role', 'pelanggan')->count(),
            'totalOrder' => \App\Models\Order::count(),
            'orders' => \App\Models\Order::with('user')->latest()->take(5)->get()
        ]);
    }
}
