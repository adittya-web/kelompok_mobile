@extends('adminlte::page')

@section('title', 'Buat Booking')

@section('content_header')
    <h1>Buat Booking Baru</h1>
@stop

@section('content')
    <form action="{{ route('user.bookings.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="service_id">Layanan</label>
            <select name="service_id" id="service_id" class="form-control" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" data-harga="{{ $service->harga }}">
                        {{ $service->nama }} (Rp {{ number_format($service->harga, 0, ',', '.') }}/kg)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="weight">Berat (kg)</label>
            <input type="number" name="weight" id="weight" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="total_price">Total Harga</label>
            <input type="text" class="form-control" id="total_price" readonly>
        </div>

        <div class="form-group">
            <label for="pickup_date">Tanggal Penjemputan</label>
            <input type="date" name="pickup_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea name="address" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Booking</button>
    </form>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceSelect = document.getElementById('service_id');
        const weightInput = document.getElementById('weight');
        const totalPriceInput = document.getElementById('total_price');

        function updateTotalPrice() {
            const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const berat = parseFloat(weightInput.value);

            if (harga && berat && berat > 0) {
                const total = harga * berat;
                totalPriceInput.value = 'Rp ' + Number(total).toLocaleString('id-ID');
            } else {
                totalPriceInput.value = '';
            }
        }

        serviceSelect.addEventListener('change', updateTotalPrice);
        weightInput.addEventListener('input', updateTotalPrice);
    });
</script>
@stop
