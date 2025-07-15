@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Manajemen User</h4>
        </div>
    

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table id="krs-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jumlah Booking</th>
                        <th>Total Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users  as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->bookings_count }}</td>
                            <td>Rp {{ number_format($user->total_paid, 0, ',', '.') }}</td>
                        </tr>
                    @empty
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
