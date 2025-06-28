@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama User</th>
                <th>Metode</th>
                <th>Status</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->booking->user->name ?? 'N/A' }}</td>
                <td>{{ $payment->payment_method }}</td>
                <td>{{ $payment->payment_status }}</td>
                <td>
                    @if($payment->proof_image)
                        <img src="{{ asset('storage/payments/' . $payment->proof_image) }}" width="100">
                    @else
                        Tidak Ada Bukti
                    @endif
                </td>
                <td>
                    @if($payment->payment_status !== 'Confirmed')
                        <form action="{{ route('payments.confirm', $payment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                        </form>
                    @else
                        Bukti Sudah Dikonfirmasi
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
