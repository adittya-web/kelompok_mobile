@extends('adminlte::page')

@section('title', 'Dashboard Pengguna')

@section('body_class', 'dark-mode')

@section('content_header')
    <h1 class="text-white font-weight-bold">Dashboard Pengguna</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-4 col-6">
        <x-adminlte-small-box title="{{ $userBookingCount }}" text="Booking Saya"
            icon="fas fa-shopping-cart" theme="primary" url="/user/booking" url-text="Lihat Booking" />
    </div>

    <div class="col-lg-4 col-6">
        <x-adminlte-small-box title="{{ $completedPayments }}" text="Pembayaran Berhasil"
            icon="fas fa-check-circle" theme="success" url="/user/payments" url-text="Lihat Pembayaran" />
    </div>

    <div class="col-lg-4 col-6">
        <x-adminlte-small-box title="{{ $pendingPayments }}" text="Menunggu Pembayaran"
            icon="fas fa-hourglass-half" theme="warning" url="/user/payments?status=Pending" url-text="Bayar Sekarang" />
    </div>
</div>

{{-- Riwayat ringkas --}}


{{-- Notifikasi --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Tips: Upload bukti pembayaran segera setelah melakukan booking agar pesanan Anda diproses lebih cepat!
        </div>
    </div>
</div>
@stop
