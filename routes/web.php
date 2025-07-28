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
    use App\Http\Controllers\user\UserDashboardController;
    use App\Http\Controllers\user\UserBookingController;
    use App\Http\Controllers\user\UserPaymentController;

    // Halaman awal bisa diarahkan ke login
    // Route::get('/', function () {
    //     return redirect('/login');
    //  });

    // Login & Logout

    Route::get('/', [LoginController::class, 'welcome'])->name('welcome');
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

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


    Route::middleware(['auth'])->group(function () {
        Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
        Route::get('/user/booking', [UserBookingController::class, 'index'])->name('user.bookings.index');
        Route::get('/user/booking/create', [UserBookingController::class, 'create'])->name('user.bookings.create');
        Route::post('/user/booking/store', [UserBookingController::class, 'store'])->name('user.bookings.store');
        Route::get('/user/booking/{id}/edit', [UserBookingController::class, 'edit'])->name('user.bookings.edit');
        Route::put('/user/booking/{id}', [UserBookingController::class, 'update'])->name('user.bookings.update');
        Route::delete('/user/booking/{id}', [UserBookingController::class, 'destroy'])->name('user.bookings.destroy');

        Route::get('/user/payments', [UserPaymentController::class, 'index'])->name('user.payments.index');
        Route::get('/user/payments/create', [UserPaymentController::class, 'create'])->name('user.payments.create');
        Route::get('/upload-bukti/{booking}', [UserPaymentController::class, 'create'])->name('user.payments.upload');
        Route::post('/upload-bukti', [UserPaymentController::class, 'store'])->name('user.payments.store');
    });
