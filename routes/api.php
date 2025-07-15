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



Route::post('/bookings', [BokingController::class, 'store'])->middleware('auth:sanctum');
Route::get('/bookings', [BokingController::class, 'index'])->middleware('auth:sanctum');
Route::get('/bookings/{id}', [BokingController::class, 'show'])->middleware('auth:sanctum');
Route::get('/payments', [PaymentApiController::class, 'index'])->middleware('auth:sanctum');

Route::apiResource('payments', PaymentController::class)->middleware('auth:sanctum');


Route::apiResource('ordertrakings', OrderTrackingController::class);
Route::apiResource('users', UserController::class);

// === Protected Routes with Sanctum Middleware ===
Route::middleware('auth:sanctum')->group(function () {

    // Booking
    Route::post('/bookings', [BokingController::class, 'store']);
    Route::get('/bookings', [BokingController::class, 'index']);
    Route::get('/bookings/{id}', [BokingController::class, 'show']);

    // Payments
    Route::apiResource('payments', PaymentController::class);

    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });
});
