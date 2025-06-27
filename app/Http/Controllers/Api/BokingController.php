<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BokingController extends Controller
{
    // GET /api/bookings - Menampilkan semua booking milik user
    public function index(Request $request)
    {
        $bookings = Booking::with('service')
                    ->where('user_id', $request->user()->id)
                    ->latest()
                    ->get();

        return response()->json([
            'success' => true,
            'data' => $bookings
        ]);
    }

    // POST /api/bookings - Membuat booking baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_id'   => 'required|exists:services,id',
            'weight'       => 'required|numeric|min:1',
            'pickup_date'  => 'required|date',
            'address'      => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $service = Service::find($request->service_id);
        $total_price = $service->price_per_kg * $request->weight;

        $booking = Booking::create([
            'user_id'     => $request->user()->id,
            'service_id'  => $request->service_id,
            'weight'      => $request->weight,
            'pickup_date' => $request->pickup_date,
            'address'     => $request->address,
            'total_price' => $total_price,
            'status'      => 'Menunggu Konfirmasi',
        ]);

        return response()->json([
            'success' => true,
            'data' => $booking
        ], 201);
    }

    // GET /api/bookings/{id} - Menampilkan detail booking
    public function show($id)
{
    $booking = Booking::with('service')->find($id);

    if (!$booking) {
        return response()->json([
            'success' => false,
            'message' => 'Booking tidak ditemukan'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $booking
    ]);
}

}
