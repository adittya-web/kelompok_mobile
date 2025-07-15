<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Booking</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
    </style>
</head>
<body>
    <h3>Laporan Booking Bulan {{ \Carbon\Carbon::parse($month)->format('F Y') }}</h3>

    <table>
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

    <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
</body>
</html>
