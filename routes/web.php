<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\user\PaymentUserController as UserPaymentController;

// Halaman awal bisa diarahkan ke login
Route::get('/', function () {
    return redirect('/login');
});

// Login & Logout

Route::get('/', [LoginController::class, 'welcome'])->name('welcome');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/booking', [DashboardController::class, 'booking'])->name('dashboard.booking');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{id}/update-status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::resource('/services', ServiceController::class);

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/{id}/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');
    Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');

    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');

    Route::get('/laporan', [ReportController::class, 'index'])->name('report.index');
    Route::get('/laporan/cetak', [ReportController::class, 'exportPdf'])->name('report.export');
});

// User routes
Route::middleware(['auth'])->group(function () {
    Route::get('/upload-bukti/{booking}', [UserPaymentController::class, 'create'])->name('user.payments.upload');
    Route::post('/upload-bukti', [UserPaymentController::class, 'store'])->name('user.payments.store');

});

