<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;

class UserPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.service')
            ->whereHas('booking', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('user.payments.index', compact('payments'));
    }

    public function create(Booking $booking)
    {
        $booking->load('service');

        return view('user.payments.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id'      => 'required|exists:bookings,id',
            'payment_method'  => 'required|in:Transfer,COD',
            'proof_image'     => $request->payment_method === 'Transfer'
                ? 'required|image|mimes:jpeg,png,jpg|max:2048'
                : 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($request->booking_id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        $imagePath = null;
        if ($request->payment_method === 'Transfer' && $request->hasFile('proof_image')) {
            $imagePath = $request->file('proof_image')->store('bukti_pembayaran', 'public');
        }

        Payment::create([
            'booking_id'     => $request->booking_id,
            'payment_method' => $request->payment_method,
            'payment_status' => 'Pending',
            'proof_image'    => $imagePath,
            'paid_at'        => now(),
        ]);

        return redirect()->route('user.payments.index')->with('success', 'Bukti pembayaran berhasil dikirim.');
    }
}
