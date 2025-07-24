<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\FirebaseNotificationService;
use App\Models\User;

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

    // PUT /api/bookings/{id} - Update status booking + kirim notifikasi FCM
  public function update(Request $request, $id)
{
    $booking = Booking::with('user')->find($id);
    if (!$booking) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    $booking->status = $request->status;
    $booking->save();

    $user = $booking->user;
    if ($user && $user->fcm_token) {
        $status = $booking->status;
        $title = "Status Pesanan Anda";
        $body = match ($status) {
            'Diproses' => "Pesanan #{$booking->id} sedang diproses oleh tim laundry.",
            'Dikirim' => "Pesanan #{$booking->id} sedang dikirim ke alamat tujuan.",
            'Selesai' => "Pesanan #{$booking->id} telah selesai. Terima kasih!",
            default => "Status pesanan #{$booking->id} diperbarui.",
        };

        // Data tambahan untuk navigasi
        $additionalData = [
            'type' => 'booking_update',
            'booking_id' => (string)$booking->id,
            'status' => $status,
            'user_id' => (string)$user->id,
        ];

        $firebase = new FirebaseNotificationService();
        $firebase->sendToDevice($user->fcm_token, $title, $body, $additionalData);
    }

    return response()->json(['message' => 'Status berhasil diperbarui']);
}
public function sendTestNotification(Request $request)
{
    $user = $request->user();

    if (!$user || !$user->fcm_token) {
        return response()->json([
            'message' => 'FCM token tidak ditemukan',
        ], 400);
    }

    $title = "Notifikasi Tes";
    $body = "Ini adalah notifikasi percobaan dari sistem.";
    $data = [
        'type' => 'test',
        'user_id' => (string)$user->id,
    ];

    $firebase = new \App\Services\FirebaseNotificationService();
    $result = $firebase->sendToDevice($user->fcm_token, $title, $body, $data);

    return response()->json([
        'message' => 'Notifikasi tes berhasil dikirim',
        'firebase_response' => $result,
    ]);
}
}
