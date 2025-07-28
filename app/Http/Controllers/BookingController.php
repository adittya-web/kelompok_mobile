<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // GET /api/bookings - Menampilkan semua booking milik user
    public function index()
    {
        $bookings = Booking::with(['user', 'service'])->latest()->get();
        return view('admin.bokings.index', compact('bookings'));
    }

    

    // POST /api/bookings - Membuat booking baru
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string'
        ]);

        $booking = Booking::with('user')->findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        $user = $booking->user;
        if ($user && $user->fcm_token) {
            $status = $booking->status;
            $title = "Status Pesanan Anda";
            $body = match ($status) {
                'Diproses' => "Pesanan #{$booking->id} sedang diproses oleh tim laundry.",
                'Dikirim' => "Pesanan #{$booking->id} sedang dikirim ke alamat tujuan.",
                'Selesai' => "Pesanan #{$booking->id} telah selesai. Terima kasih!",
                default => "Status pesanan #{$booking->id} diperbarui.",
            };

            $additionalData = [
                'type' => 'booking_update',
                'booking_id' => (string)$booking->id,
                'status' => $status,
                'user_id' => (string)$user->id,
            ];

           $firebase = new \App\Services\FirebaseNotificationService();
            $firebase->sendToDevice($user->fcm_token, $title, $body, $additionalData);
        }

        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}