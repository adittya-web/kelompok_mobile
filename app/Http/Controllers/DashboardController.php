<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bookingCount = Booking::count();

        $pendingPayments = Payment::where('payment_status', 'Pending')->count();

        $totalRevenue = Booking::whereHas('payment', function ($q) {
            $q->where('payment_status', 'Lunas');
        })->sum('total_price');

        // Grafik Pendapatan Bulanan
        $revenues = DB::table('payments')
            ->join('bookings', 'payments.booking_id', '=', 'bookings.id')
            ->selectRaw('MONTH(payments.paid_at) as month, SUM(bookings.total_price) as total')
            ->where('payments.payment_status', 'Lunas')
            ->whereYear('payments.paid_at', date('Y'))
            ->groupBy(DB::raw('MONTH(payments.paid_at)'))
            ->pluck('total', 'month');

        $monthlyRevenue = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[] = $revenues[$i] ?? 0;
        }

        return view('dashboard', compact(
            'bookingCount',
            'pendingPayments',
            'totalRevenue',
            'monthlyRevenue'
        ));
    }
}
