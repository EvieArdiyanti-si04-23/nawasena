@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">🛒 Keranjang Pesanan</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <table class="table table-bordered">
            <thead class="table-warning">
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($cart as $id => $item)
                    @php
                        $total = $item['harga'] * $item['quantity'];
                        $grandTotal += $total;
                    @endphp
                    <tr>
                        <td>{{ $item['nama_menu'] }}</td>
                        <td>Rp {{ number_format($item['harga']) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>Rp {{ number_format($total) }}</td>
                        <td>{{ $item['catatan'] ?? '-' }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $id }}">
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h5>Total Pesanan: <strong>Rp {{ number_format($grandTotal) }}</strong></h5>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">✅ Pesan Sekarang</button>
            </form>
        </div>
    @else
        <p class="text-muted">Keranjang Pesanan kosong.</p>
    @endif

    <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-secondary mt-3">← Kembali ke Menu</a>
</div>
@endsection
