@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Data Booking</h4>
        </div>

        <div class="card-body table-responsive">
            <table id="krs-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Layanan</th>
                        <th>Berat (kg)</th>
                        <th>Tanggal Jemput</th>
                        <th>Alamat</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->id }}</td>
                        <td>{{ $booking->user->name ?? '-' }}</td>
                        <td>{{ $booking->service->nama ?? '-' }}</td>
                        <td>{{ $booking->weight }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->pickup_date)->format('d M Y') }}</td>
                        <td>{{ $booking->address }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badgeColor = match($booking->status) {
                                    'Menunggu Konfirmasi' => 'secondary',
                                    'Diproses' => 'info',
                                    'Selesai' => 'success',
                                    'Dikirim' => 'warning',
                                    default => 'dark'
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeColor }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <select name="status" class="form-select" required>
                                        <option value="Menunggu Konfirmasi" {{ $booking->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                        <option value="Diproses" {{ $booking->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Selesai" {{ $booking->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Dikirim" {{ $booking->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Tidak ada data booking</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@stop

@section('js')
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#krs-table').DataTable();
        });
    </script>
@stop
