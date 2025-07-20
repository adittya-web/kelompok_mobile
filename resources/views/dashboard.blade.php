@extends('adminlte::page')

@section('title', 'Dashboard v2')

@section('body_class', 'dark-mode')

@section('content_header')
    <h1 class="text-white font-weight-bold">Dashboard Admin Laundry</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $bookingCount }}" text="Total Booking"
            icon="fas fa-calendar-check" theme="info" url="/bookings" url-text="Lihat Booking" />
    </div>

    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $pendingPayments }}" text="Pending Payment"
            icon="fas fa-money-bill-wave" theme="warning" url="/payments?status=Pending" url-text="Lihat Pembayaran" />
    </div>

    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="Rp {{ number_format($totalRevenue, 0, ',', '.') }}" text="Total Revenue"
            icon="fas fa-coins" theme="success" url="/laporan" url-text="Lihat Laporan" />
    </div>
</div>

{{-- Grafik Pendapatan --}}
<div class="row mt-4">
    <div class="col-md-12">
        <x-adminlte-card title="Grafik Pendapatan Bulanan {{ date('Y') }}" theme="dark" icon="fas fa-chart-line" collapsible>
            <canvas id="revenueChart" style="height: 300px; width: 100%;"></canvas>
        </x-adminlte-card>
    </div>
</div>

{{-- Tips / Notifikasi --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Tips: Cek pembayaran pending secara rutin untuk meningkatkan layanan!
        </div>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json($monthlyRevenue),
                borderColor: 'rgba(0, 123, 255, 1)',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: { labels: { color: 'white' } }
            },
            scales: {
                x: {
                    ticks: { color: 'white' }
                },
                y: {
                    ticks: {
                        color: 'white',
                        beginAtZero: true,
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@stop
