@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📋 Daftar Menu Kedai Nawasena</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.menu.create') }}" class="btn btn-primary mb-3">+ Tambah Menu</a>

    <table class="table table-bordered">
        <thead class="table-warning">
            <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Kategori</th>
                <th>stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->nama_menu }}</td>
                <td>{{ $menu->deskripsi }}</td>
                <td>Rp {{ number_format($menu->harga) }}</td>
                <td>{{ ucfirst($menu->kategori) }}</td>
                <td>{{ $menu->stok }}</td>
                <td>
                    @if($menu->gambar)
                        <img src="{{ asset('storage/' . $menu->gambar) }}" width="70">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>
@endsection