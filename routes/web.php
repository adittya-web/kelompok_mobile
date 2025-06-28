<?php

use App\Http\Controllers\PaymentAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BokingController;
use App\Http\Controllers\ControllerService;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('services',ControllerService::class);
Route::get('/payments', [App\Http\Controllers\PaymentAdminController::class, 'index']);
Route::post('payments/{id}/confirm', [PaymentAdminController::class, 'confirm'])->name('payments.confirm');
