@extends('layouts.admin') {{-- Pastikan layouts/admin.blade.php sudah ada --}}

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-danger">📦 Detail Pesanan</h3>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Nama Pelanggan:</strong> {{ $order->user->name }}</p>
            <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($order->details->sum(function($item) {return $item->harga * $item->jumlah;})) }}</p>
        </div>
    </div>

    <h5 class="mb-3 text-warning">🧾 Daftar Item</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $detail)
                <tr>
                    <td>{{ $detail->menu->nama_menu }}</td>
                    <td>Rp {{ number_format($detail->harga) }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp {{ number_format($detail->subtotal) }}</td>
                    <td>{{ $detail->notes ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>
@endsection
