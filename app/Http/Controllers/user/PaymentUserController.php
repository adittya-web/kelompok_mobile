<?php
namespace App\Http\Controllers\user;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentUserController extends Controller
{
    public function create(\App\Models\Booking $booking)
    {
        return view('user.payments.upload', compact('booking'));
        return redirect()->route('user.dashboard')->with('success', 'Pembayaran Anda telah dikonfirmasi. Terima kasih!');

    }

public function store(Request $request)
{
    $request->validate([
        'booking_id' => 'required|exists:bookings,id',
        'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $path = $request->file('proof_image')->store('proofs', 'public');

    Payment::create([
        'booking_id' => $request->booking_id,
        'payment_method' => 'Transfer',
        'payment_status' => 'Pending',
        'proof_image' => $path,
        'paid_at' => now(),
    ]);

    return redirect()->route('user.dashboard')->with('success', 'Bukti pembayaran berhasil dikirim.');
}
}