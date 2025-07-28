@extends('adminlte::page')

@section('title', 'Riwayat Pembayaran')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Riwayat Pembayaran</h1>
    </div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Booking</th>
                <th>Layanan</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Tanggal Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>#{{ $payment->booking_id }}</td>
                <td>{{ $payment->booking->service->nama ?? '-' }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>
                    @if($payment->payment_status === 'Pending')
                        <span class="badge badge-warning">Pending</span>
                    @else
                        <span class="badge badge-success">Completed</span>
                    @endif
                </td>
                <td>
                    @if($payment->proof_image)
                        <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank">Lihat</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $payment->paid_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop
