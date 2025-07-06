<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Tampilkan halaman register
    public function showRegistrationForm()
    {
        return view('register'); // pastikan file `register.blade.php` ada di folder resources/views
    }

    // Proses pendaftaran
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user', // default role
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Redirect ke halaman dashboard atau lain
        return redirect()->route('dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }
}
