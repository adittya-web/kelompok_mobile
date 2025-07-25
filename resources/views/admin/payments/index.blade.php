@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="mb-4">
        <form method="GET" class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="statusFilter" class="col-form-label fw-bold text-white">
                    <i class="fas fa-filter"></i> Filter Status:
                </label>
            </div>
            <div class="col-auto">
                <select name="status" id="statusFilter" class="form-select form-select-sm shadow-sm" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Lunas" {{ request('status') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                </select>
            </div>
        </form>
    </div>
    

    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Data Pembayaran</h4>
        </div>

        <div class="card-body table-responsive">
            <table id="krs-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ optional(optional($payment->booking)->user)->name ?? '-' }}</td>
                            <td>{{ $payment->payment_method }}</td>
                            <td>
                                <span class="badge bg-{{ $payment->payment_status === 'Lunas' ? 'success' : 'warning' }}">
                                    {{ $payment->payment_status }}
                                </span>
                            </td>
                            <td>
                                @if($payment->proof_image)
                                    <a href="{{ asset('storage/' . $payment->proof_image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $payment->proof_image) }}" width="80" class="img-thumbnail" />
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada bukti</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    @if($payment->payment_status !== 'Lunas')
                                        <form action="{{ route('payments.confirm', $payment->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pembayaran ini?')">
                                                <i class="fas fa-check-circle"></i> Konfirmasi
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-success"><i class="fas fa-check-circle"></i> Sudah dikonfirmasi</span>
                                    @endif

                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Hapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data pembayaran.</td>
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
        $.fn.dataTable.ext.errMode = 'throw';
        $(document).ready(function() {
            $('#krs-table').DataTable();
        });
    </script>
@stop
