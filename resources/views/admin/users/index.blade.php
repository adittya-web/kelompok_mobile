@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Manajemen User</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Jumlah Booking</th>
                <th>Total Pembayaran (Lunas)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->bookings_count }}</td>
                <td>Rp {{ number_format($user->total_paid, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
