@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Laporan Booking Bulanann</h2>

    <form method="GET" action="{{ route('report.index') }}" class="form-inline mb-3">
        <label for="month">Pilih Bulan: &nbsp;</label>
        <input type="month" name="month" class="form-control" value="{{ $month }}">
        <button class="btn btn-primary ml-2">Tampilkan</button>
        <a href="{{ route('report.export', ['month' => $month]) }}" class="btn btn-success ml-2">Export PDF</a>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User</th>
                <th>Layanan</th>
                <th>Tanggal Ambil</th>
                <th>Berat</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->service->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d-m-Y') }}</td>
                <td>{{ $booking->weight }} kg</td>
                <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                <td>{{ $booking->payment->payment_status ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="alert alert-info">
        <strong>Total Pendapatan:</strong> Rp {{ number_format($totalRevenue, 0, ',', '.') }}
    </div>
</div>
@endsection
