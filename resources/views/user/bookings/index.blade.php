@extends('adminlte::page')

@section('title', 'Riwayat Booking')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="font-weight-bold">Riwayat Booking Anda</h1>
        <a href="{{ route('user.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Booking
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($bookings->isEmpty())
        <div class="alert alert-info mt-3">Anda belum pernah melakukan booking.</div>
    @else
        <table class="table table-bordered table-striped mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Layanan</th>
                    <th>Berat (kg)</th>
                    <th>Tanggal Penjemputan</th>
                    <th>Alamat</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->service->nama }}</td>
                    <td>{{ $booking->weight }}</td>
                    <td>{{ $booking->pickup_date }}</td>
                    <td>{{ $booking->address }}</td>
                    <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if($booking->status === 'menunggu konfirmasi') badge-warning
                            @elseif($booking->status === 'selesai') badge-success
                            @else badge-secondary
                            @endif
                        ">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('user.bookings.edit', $booking->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('user.bookings.destroy', $booking->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus booking ini?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    
                        {{-- Tampilkan tombol bayar hanya jika status selesai dan belum dibayar --}}
                        @if($booking->status === 'Selesai' && !$booking->payment)
                            <a href="{{ route('user.payments.upload', $booking->id) }}" class="btn btn-sm btn-success mt-1">
                                <i class="fas fa-credit-card"></i> Bayar
                            </a>
                        @elseif($booking->payment)
                            <span class="badge badge-info mt-1">Sudah Dibayar</span>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop
