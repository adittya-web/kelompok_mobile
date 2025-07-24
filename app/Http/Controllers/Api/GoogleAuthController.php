<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Auth;

class GoogleAuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = (new Factory)
            ->withServiceAccount(config('firebase.credentials'))
            ->createAuth();
    }

    public function loginWithGoogle(Request $request)
    {
        try {
            $idToken = $request->input('id_token');

            if (!$idToken) {
                return response()->json([
                    'message' => 'ID Token tidak ditemukan dalam request.',
                ], 400);
            }

            // ✅ Verifikasi ID Token dari Firebase
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
            $uid = $verifiedIdToken->claims()->get('sub');

            if (!$uid) {
                return response()->json([
                    'message' => 'Login Google gagal',
                    'error'   => 'UID tidak ditemukan dari ID Token.',
                ], 400);
            }

            // ✅ Ambil data user dari Firebase
            $firebaseUser = $this->auth->getUser($uid);

            $email = $firebaseUser->email ?? null;
            $name  = $firebaseUser->displayName ?? 'Google User';

            if (!$email) {
                return response()->json([
                    'message' => 'Login Google gagal',
                    'error'   => 'Email tidak tersedia dari Firebase User.',
                ], 400);
            }

            // ✅ Buat atau ambil user lokal
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name'     => $name,
                    'password' => Hash::make(Str::random(16)), // Password random
                ]
            );

            // ✅ Generate token Laravel Sanctum
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'message' => 'Login Google berhasil',
                'token'   => $token,
                'user'    => $user,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Login Google gagal',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
