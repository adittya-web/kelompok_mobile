<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Auth as FirebaseAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Auth;

class AuthController extends Controller
{
    public function firebaseLogin(Request $request)
    {
        $request->validate([
            'firebase_token' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
        ]);

        try {
            $firebaseAuth = app('firebase.auth');
            $verifiedIdToken = $firebaseAuth->verifyIdToken($request->firebase_token);
            $firebaseUid = $verifiedIdToken->claims()->get('sub');
        } catch (\Throwable $e) {
            return response()->json(['message' => 'Invalid Firebase token'], 401);
        }

        $user = User::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $token = $user->createToken('token-name')->plainTextToken;
    
        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ]);
    }
    

}
