@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-calendar-check"></i> Data Booking</h4>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Tambah Layanan
            </a>
        </div>
    

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table id="krs-table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Layanan</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->nama }}</td>
                            <td>{{ $service->keterangan }}</td>
                            <td>Rp {{ number_format($service->harga, 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex gap-1 flex-wrap">
                                    <a href="{{ route('services.edit', $service->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada layanan tersedia.</td>
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
