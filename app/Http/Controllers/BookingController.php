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
        $bookings = \App\Models\Booking::with(['user', 'service'])->latest()->get();
        return view('admin.bokings.index', compact('bookings'));
    }
    

    // POST /api/bookings - Membuat booking baru
    public function updateStatus(Request $request, $id) 
    {
        $request->validate([
            'status' => 'required|string'
        ]);
        
        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();
        return redirect()->back()->with('success', 'Status berhasil diperbarui!');
    }
}
