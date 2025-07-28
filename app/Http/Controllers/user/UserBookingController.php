<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('service')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $services = Service::all();
        return view('user.bookings.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'   => 'required|exists:services,id',
            'weight'       => 'required|numeric|min:1',
            'pickup_date'  => 'required|date',
            'address'      => 'required|string|max:255',
        ]);

        $service = Service::find($request->service_id);
        $totalPrice = $request->weight * $service->harga;

        Booking::create([
            'user_id'      => Auth::id(),
            'service_id'   => $request->service_id,
            'weight'       => $request->weight,
            'pickup_date'  => $request->pickup_date,
            'address'      => $request->address,
            'total_price'  => $totalPrice,
            'status' => 'menunggu konfirmasi',
        ]);

        return redirect()->route('user.bookings.index')->with('success', 'Booking berhasil dibuat.');
    }

    public function edit($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $services = Service::all();

        return view('user.bookings.edit', compact('booking', 'services'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'service_id'   => 'required|exists:services,id',
            'weight'       => 'required|numeric|min:1',
            'pickup_date'  => 'required|date',
            'address'      => 'required|string|max:255',
        ]);

        $service = Service::find($request->service_id);
        $totalPrice = $request->weight * $service->harga;

        $booking->update([
            'service_id'   => $request->service_id,
            'weight'       => $request->weight,
            'pickup_date'  => $request->pickup_date,
            'address'      => $request->address,
            'total_price'  => $totalPrice,
        ]);

        return redirect()->route('user.bookings.index')->with('success', 'Booking berhasil diupdate.');
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $booking->delete();

        return redirect()->route('user.bookings.index')->with('success', 'Booking berhasil dihapus.');
    }
}
