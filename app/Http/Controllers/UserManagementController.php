<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserManagementController extends Controller
{
    public function index()
{
    $users = \App\Models\User::withCount('bookings')
        ->with(['bookings' => function ($query) {
            $query->with(['payment' => function ($q) {
                $q->where('payment_status', 'Lunas');
            }]);
        }])
        ->get();

    // Hitung total pembayaran lunas per user
    foreach ($users as $user) {
        $user->total_paid = $user->bookings->sum(function ($booking) {
            return optional($booking->payment)->payment_status === 'Lunas' ? $booking->total_price : 0;
        });
    }

    return view('admin.users.index', compact('users'));
}

}
