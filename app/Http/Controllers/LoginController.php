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

        // Cek user dan password
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['name' => 'Nama pengguna atau kata sandi salah.']);

        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Arahkan berdasarkan role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'user') {
            return redirect()->route('user.dashboard');
        }

        // Jika role tidak dikenali
        Auth::logout();
        return back()->with('error', 'Akses ditolak! Role tidak dikenali.');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
