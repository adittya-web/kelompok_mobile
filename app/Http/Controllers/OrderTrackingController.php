<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderTraking;
use Illuminate\Http\Request;

class OrderTrakingController extends Controller
{
    // GET /api/bookings/{booking_id}/tracking - Lihat riwayat tracking
    public function index($booking_id, Request $request)
    {
        $trackings = TrackingHistory::where('booking_id', $booking_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $trackings
        ]);
    }

    // POST /api/trackings - Admin menambahkan status tracking
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'status'     => 'required|string',
            'note'       => 'nullable|string',
        ]);

        $tracking = TrackingHistory::create([
            'booking_id' => $request->booking_id,
            'status'     => $request->status,
            'note'       => $request->note,
        ]);

        return response()->json(['success' => true, 'data' => $tracking]);
    }
}
