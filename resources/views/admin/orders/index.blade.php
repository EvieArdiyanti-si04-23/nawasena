@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">🧾 Riwayat Pesanan Pelanggan</h3>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->user->name }}</td>
                <td>
                    Rp {{ number_format(
                        $order->details->sum(function($item) {
                            return $item->harga * $item->jumlah;
                        })
                    ) }}
                </td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>
@endsection