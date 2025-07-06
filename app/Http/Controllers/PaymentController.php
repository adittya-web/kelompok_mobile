<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status'); // dapatkan status dari query URL
    
        $query = Payment::with('booking.user')->latest();
    
        if ($status && in_array($status, ['Pending', 'Lunas'])) {
            $query->where('payment_status', $status);
        }
    
        $payments = $query->get();
    
        return view('admin.payments.index', compact('payments', 'status'));
    }

    public function confirm($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->payment_status = 'Lunas';
        $payment->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function destroy($id)
{
    $payment = Payment::findOrFail($id);

    // Hapus gambar bukti jika ada
    if ($payment->proof_image && \Storage::exists('public/' . $payment->proof_image)) {
        \Storage::delete('public/' . $payment->proof_image);
    }

    $payment->delete();

    return redirect()->back()->with('success', 'Pembayaran berhasil dihapus.');
}

}
