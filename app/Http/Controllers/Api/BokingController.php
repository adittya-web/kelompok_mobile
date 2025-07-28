<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Payment;
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
            'address'      => 'required|string|max:255' // ✅ tambahkan validasi ini
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $service = Service::find($request->service_id);
        $total_price = $service->harga * $request->weight;

        $booking = Booking::create([
            'user_id'     => $request->user()->id,
            'service_id'  => $request->service_id,
            'weight'      => $request->weight,
            'pickup_date' => $request->pickup_date,
            'address'     => $request->address,
            'total_price' => $total_price,
            'status'      => 'Menunggu Konfirmasi',
        ]);

        $booking->load('service'); // ⬅️ ini penting

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil',
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

    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $booking->status = $request->status;
        $booking->save();

        return response()->json(['message' => 'Status berhasil diperbarui']);
    }
}
