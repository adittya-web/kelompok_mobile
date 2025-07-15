<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));

        $bookings = Booking::with('user', 'service')
            ->whereMonth('pickup_date', Carbon::parse($month)->month)
            ->whereYear('pickup_date', Carbon::parse($month)->year)
            ->get();

        $totalRevenue = $bookings->sum(function ($booking) {
            return optional($booking->payment)->payment_status === 'Lunas' ? $booking->total_price : 0;
        });

        return view('reports.index', compact('bookings', 'totalRevenue', 'month'));
    }

    public function exportPdf(Request $request)
    {
        $month = $request->input('month', Carbon::now()->format('Y-m'));

        $bookings = Booking::with('user', 'service')
            ->whereMonth('pickup_date', Carbon::parse($month)->month)
            ->whereYear('pickup_date', Carbon::parse($month)->year)
            ->get();

        $totalRevenue = $bookings->sum(function ($booking) {
            return optional($booking->payment)->payment_status === 'Lunas' ? $booking->total_price : 0;
        });

        $pdf = PDF::loadView('reports.pdf', compact('bookings', 'totalRevenue', 'month'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('laporan-booking-' . $month . '.pdf');
    }
}
