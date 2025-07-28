<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('user.dashboard', [
            'userBookingCount' => $user->bookings()->count(),
            'completedPayments' => $user->payments()->where('status', 'Completed')->count(),
            'pendingPayments' => $user->payments()->where('status', 'Pending')->count(),
            // 'recentActivities' => $user->activities()->latest()->limit(5)->get(), // HAPUS BARIS INI
        ]);
    }
}
