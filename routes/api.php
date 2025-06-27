<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\BokingController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\OrderTrackingController;  
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

Route::apiResource('services', ServiceController::class);
Route::apiResource('bokings', BokingController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('ordertrakings', OrderTrackingController::class);
Route::apiResource('users', UserController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function 
(Request $request) {
return $request->user();
}); 