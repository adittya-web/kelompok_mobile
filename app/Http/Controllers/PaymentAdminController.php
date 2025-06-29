<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentAdminController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.user')->latest()->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function confirm($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->payment_status = 'Confirmed';
        $payment->save();

        return redirect()->back()->with('success', 'Pembayaran telah dikonfirmasi.');
    }
}
