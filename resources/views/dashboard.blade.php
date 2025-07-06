@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-primary font-weight-bold">Dashboard Admin Laundry</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <x-adminlte-small-box title="{{ $bookingCount }}" text="Total Booking"
            icon="fas fa-calendar-check" theme="info" url="/bookings" url-text="Lihat Booking" />
    </div>

    <div class="col-md-4">
        <x-adminlte-small-box title="{{ $pendingPayments }}" text="Pending Payment"
            icon="fas fa-money-bill-wave" theme="warning" url="/payments?status=Pending" url-text="Lihat Pembayaran" />
    </div>

    <div class="col-md-4">
        <x-adminlte-small-box title="Rp {{ number_format($totalRevenue, 0, ',', '.') }}" text="Total Revenue"
            icon="fas fa-coins" theme="success" url="/laporan" url-text="Lihat Laporan" />
    </div>
</div>

{{-- Bonus Section: Tips atau Notifikasi --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-primary">
            <i class="fas fa-lightbulb"></i> Tips: Cek pembayaran pending secara rutin untuk meningkatkan layanan!
        </div>
    </div>
</div>
@stop
