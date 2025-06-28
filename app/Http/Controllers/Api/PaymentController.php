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
            'proof_image'    => 'nullable|image|max:10240',
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
        $payment->paid_at = now();

        if ($request->hasFile('proof_image')) {
            try {
                $file = $request->file('proof_image');
                $filename = time() . '_' . $file->getClientOriginalName();
                // Store file directly in the storage/app/public/payments directory
                $path = $file->storeAs('payment', $filename, 'public');
                $payment->proof_image = $path; // Save the full path
                \Log::info('File uploaded successfully', ['path' => $path, 'filename' => $filename]);
            } catch (\Exception $e) {
                \Log::error('File upload failed', ['error' => $e->getMessage()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload image'
                ], 500);
            }
        }

        $payment->save();

        // Prepare response data with correct image URL
        $data = $payment->toArray();
        if ($payment->proof_image) {
            $data['proof_image_url'] = Storage::url($payment->proof_image);
        } else {
            $data['proof_image_url'] = null;
        }

        return response()->json(['success' => true, 'data' => $data]);
    }

    // GET /api/payments - Menampilkan semua pembayaran user
    public function index(Request $request)
    {
        $payments = Payment::with('booking.service')
            ->whereHas('booking', function ($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })->latest()->get();
    
        $data = $payments->map(function ($payment) {
            $data = [
                'id' => $payment->id,
                'booking_id' => $payment->booking_id,
                'payment_method' => $payment->payment_method,
                'payment_status' => $payment->payment_status,
                'paid_at' => $payment->paid_at,
'proof_image_url' => $payment->proof_image 
    ? url('storage/' . $payment->proof_image)
    : null
            ];
            return $data;
        });
    
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    
}
