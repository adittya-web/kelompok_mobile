<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    // POST /api/payments - Upload bukti pembayaran
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'booking_id'     => 'required|exists:bookings,id',
            'payment_method' => 'required|in:Transfer,COD',
            'proof_image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $booking = Booking::find($request->booking_id);

        if (!$booking || $booking->user_id !== $request->user()->id) {
            return response()->json(['success' => false, 'message' => 'Booking tidak valid'], 403);
        }

        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->payment_method = $request->payment_method;
        $payment->payment_status = 'Pending';

        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/payments', $filename);
            $payment->proof_image = $filename;
        }

        $payment->paid_at = now();
        $payment->save();

        return response()->json(['success' => true, 'data' => $payment]);
    }

    // GET /api/payments - Menampilkan semua pembayaran user
    public function index(Request $request)
    {
        $payments = Payment::with('booking.service')
                    ->whereHas('booking', function ($q) use ($request) {
                        $q->where('user_id', $request->user()->id);
                    })->latest()->get();

        return response()->json(['success' => true, 'data' => $payments]);
    }
}
