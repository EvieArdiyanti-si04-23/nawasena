@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📜 Riwayat Pesanan</h3>

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <strong>Pesanan #{{ $order->id }}</strong> &nbsp; 
                    <span class="float-end">Total: <strong>Rp {{ number_format(
                        $order->details->sum(function($item) {
                            return $item->harga * $item->jumlah;
                        })
                    ) }}</strong></span>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($order->details as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->menu->nama_menu }} x {{ $item->jumlah }}
                                @if($item->catatan)
                                    <br><small class="text-muted">📝 Catatan: {{ $item->catatan }}</small>
                                @endif
                                <span>Rp {{ number_format($item->subtotal) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer text-muted">
                    Dipesan pada: {{ $order->created_at->format('d M Y H:i') }}
                </div>
            </div>
        @endforeach
    @else
        <p class="text-muted">Belum ada pesanan.</p>
    @endif

    <a href="{{ route('pelanggan.dashboard') }}" class="btn btn-secondary">← Kembali</a>
</div>
@endsection
