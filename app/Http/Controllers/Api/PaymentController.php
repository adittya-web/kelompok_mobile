<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Simpan pembayaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'payment_method' => 'required|in:Transfer,COD',
            'proof_image' => 'required_if:payment_method,Transfer|image|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('proof_image')) {
            $path = $request->file('proof_image')->store('payments', 'public');
        }

        $payment = Payment::create([
            'booking_id' => $request->booking_id,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'proof_image' => $path, // hanya simpan relative path (tanpa asset())
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikirim',
            'data' => [
                'id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'payment_method' => $payment->payment_method,
                'payment_status' => $payment->payment_status,
                'proof_image_url' => $payment->proof_image ? asset('storage/' . $payment->proof_image) : null,
            ]
        ]);
    }

    /**
     * Tampilkan semua pembayaran milik user yang login.
     */
    public function index(Request $request)
    {
        $payments = Payment::with(['booking.service'])
            ->whereHas('booking', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    /**
     * Konfirmasi pembayaran oleh admin (ubah status jadi "lunas").
     */
    public function confirm($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->payment_status = 'lunas';
        $payment->paid_at = now();
        $payment->save();

        $booking = $payment->booking;
        $booking->payment_status = 'lunas';
        $booking->save();

        return response()->json([
            'message' => 'Pembayaran dikonfirmasi',
            'payment' => [
                'id' => $payment->id,
                'payment_status' => $payment->payment_status,
                'paid_at' => $payment->paid_at,
                'proof_image_url' => $payment->proof_image
                    ? asset('storage/' . $payment->proof_image)
                    : null,
            ],
        ]);
    }
}
