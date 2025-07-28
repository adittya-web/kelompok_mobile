@extends('adminlte::page')

@section('title', 'Edit Booking')

@section('content_header')
    <h1>Edit Booking</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="service_id">Layanan</label>
            <select name="service_id" class="form-control" required>
                <option value="">-- Pilih Layanan --</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ $booking->service_id == $service->id ? 'selected' : '' }}>
                        {{ $service->nama }} (Rp {{ number_format($service->harga, 0, ',', '.') }}/kg)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="weight">Berat (kg)</label>
            <input type="number" name="weight" class="form-control" min="1" value="{{ $booking->weight }}" required>
        </div>

        <div class="form-group">
            <label for="pickup_date">Tanggal Penjemputan</label>
            <input type="date" name="pickup_date" class="form-control" value="{{ $booking->pickup_date }}" required>
        </div>

        <div class="form-group">
            <label for="address">Alamat</label>
            <textarea name="address" class="form-control" rows="3" required>{{ $booking->address }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
@stop
