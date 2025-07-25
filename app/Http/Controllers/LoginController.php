<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function welcome()
    {
        return view('auth.welcome');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $user = \App\Models\User::where('name', $credentials['name'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['name' => 'Nama pengguna atau kata sandi salah.']);
        }

        // ❗ Tambahan: tolak login untuk user role selain admin
        if ($user->role === 'user') {
            return back()->with('error', 'Anda tidak memiliki akses login.');
        }

        // Hanya admin yang bisa login
        if ($user->role !== 'admin') {
            return back()->with('error', 'Akses ditolak! Hanya admin yang diperbolehkan login.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
