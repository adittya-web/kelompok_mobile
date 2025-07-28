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
Route::post('/register', [AuthController::class, 'register']);

// === Public APIs ===
Route::apiResource('services', ServiceController::class);
Route::apiResource('ordertrakings', OrderTrackingController::class);
Route::apiResource('users', UserController::class);

// === Protected Routes ===
Route::middleware('auth:sanctum')->group(function () {
    // Booking
    Route::post('/bookings', [BokingController::class, 'store']);
    Route::get('/bookings', [BokingController::class, 'index']);
    Route::get('/bookings/{id}', [BokingController::class, 'show']);
    Route::put('/bookings/{id}', [BokingController::class, 'update']);

    // FCM Test
    Route::post('/send-test-notification', [BokingController::class, 'sendTestNotification']);

    // Payments
    Route::apiResource('payments', PaymentController::class);

    // Update FCM Token
    Route::post('/update-fcm-token', [UserController::class, 'updateFcmToken']);

    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // History
    Route::get('/history', function (Request $request) {
        $bookings = $request->user()->bookings()->with('service')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $bookings,
        ]);
    });
});
