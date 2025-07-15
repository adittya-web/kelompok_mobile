<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
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
            'proof_image_url' => $path ? asset('storage/' . $path) : null,

        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikirim',
            'data' => $payment,
        ]);
    }


    public function index(Request $request)
    {
        $payments = Payment::with('booking.service')
            ->whereHas('booking', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->latest()
            ->get();

        $data = $payments->map(function ($payment) {
            return [
                'id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'payment_method' => $payment->payment_method,
                'payment_status' => $payment->payment_status,
                'paid_at' => $payment->paid_at,


                'proof_image_url' => $payment->proof_image
                    ? asset('storage/payment/' . $payment->proof_image)
                    : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $payments // kirim langsung objek payment lengkap
        ]);
    }

    public function confirm($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->payment_status = 'lunas'; // ✅ HARUS INI, bukan $payment->status
        $payment->save();

        $booking = $payment->booking;
        $booking->payment_status = 'lunas';
        $booking->save();

        return response()->json([
            'message' => 'Pembayaran dikonfirmasi',
            'payment' => $payment,
        ]);
    }
}
