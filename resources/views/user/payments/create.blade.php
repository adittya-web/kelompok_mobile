@extends('adminlte::page')

@section('title', 'Upload Bukti Pembayaran')

@section('content_header')
    <h1>Upload Bukti Pembayaran</h1>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('user.payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

        <div class="form-group">
            <label>Layanan</label>
            <input type="text" class="form-control" value="{{ $booking->service->nama }}" readonly>
        </div>

        <div class="form-group">
            <label>Total Harga</label>
            <input type="text" class="form-control" value="Rp {{ number_format($booking->total_price, 0, ',', '.') }}" readonly>
        </div>

        <div class="form-group">
            <label>Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Transfer">Transfer</option>
                <option value="COD">Bayar di Tempat (COD)</option>
            </select>
        </div>

        <div class="form-group">
            <label>Bukti Pembayaran</label>
            <input type="file" name="proof_image" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Bukti</button>
    </form>
    @section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const methodSelect = document.querySelector('select[name="payment_method"]');
        const proofInput = document.querySelector('input[name="proof_image"]');
        const proofGroup = proofInput.closest('.form-group');

        function toggleProofInput() {
            if (methodSelect.value === 'COD') {
                proofInput.removeAttribute('required');
                proofGroup.style.display = 'none';
            } else {
                proofInput.setAttribute('required', 'required');
                proofGroup.style.display = 'block';
            }
        }

        methodSelect.addEventListener('change', toggleProofInput);
        toggleProofInput(); // initial check on load
    });
</script>
@stop

@stop
