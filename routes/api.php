<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BokingController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\OrderTrackingController;  
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

Route::apiResource('services', ServiceController::class);
Route::post('/bookings', [BokingController::class, 'store'])->middleware('auth:sanctum');
Route::get('/bookings', [BokingController::class, 'index'])->middleware('auth:sanctum');
Route::get('/bookings/{id}', [BokingController::class, 'show'])->middleware('auth:sanctum');
Route::get('/payments', [PaymentApiController::class, 'index'])->middleware('auth:sanctum');
Route::apiResource('payments', PaymentController::class)->middleware('auth:sanctum');
Route::apiResource('ordertrakings', OrderTrackingController::class);
Route::apiResource('users', UserController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function 
(Request $request) {
return $request->user();
}); 
