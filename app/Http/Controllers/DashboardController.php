<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'bookingCount' => Booking::count(),
            'pendingPayments' => Payment::where('payment_status', 'Pending')->count(),
'totalRevenue' => \App\Models\Booking::whereHas('payment', function ($q) {
    $q->where('payment_status', 'Lunas');
})->sum('total_price'),

        ]);
    }
}
