<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BokingController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\OrderTrackingController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleAuthController;

// === Auth Routes ===
Route::post('/auth/firebase', [AuthController::class, 'firebaseLogin']);
Route::post('/auth/google', [GoogleAuthController::class, 'loginWithGoogle']);
Route::post('/login', [AuthController::class, 'login']);

// === Public APIs ===
Route::apiResource('services', ServiceController::class);
Route::apiResource('ordertrakings', OrderTrackingController::class);
Route::apiResource('users', UserController::class);

// === Booking Routes with Sanctum Middleware ===
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/bookings', [BokingController::class, 'store']);
    Route::get('/bookings', [BokingController::class, 'index']);
    Route::get('/bookings/{id}', [BokingController::class, 'show']);

    // Payment protected routes
    Route::apiResource('payments', PaymentController::class);
    
    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
