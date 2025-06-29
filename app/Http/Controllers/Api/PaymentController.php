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
        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|exists:bookings,id',
            'proof_image' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $booking = Booking::find($request->booking_id);
        if (!$booking || $booking->user_id !== $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan atau bukan milik Anda'
            ], 403);
        }

        $payment = new Payment();
        $payment->booking_id = $booking->id;
        $payment->paid_at = now();
        $payment->payment_status = 'Pending';

        if ($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('/payment', $filename); // simpan ke storage/app/public/payment
                $payment->proof_image = $filename;
                $payment->payment_method = 'Transfer';
            } else {
                return response()->json(['message' => 'File tidak valid'], 422);
            }
        } else {
            $payment->payment_method = 'COD';
        }

        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikirim',
            'data' => [
                'id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'payment_method' => $payment->payment_method,
                'payment_status' => $payment->payment_status,
                'proof_image_url' => $payment->proof_image
    ? asset('storage/payment/' . $payment->proof_image)
    : null,
                'paid_at' => $payment->paid_at,
            ]
        ], 201);
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
            'data' => $data
        ]);
    }
}
