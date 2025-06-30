@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">✏️ Edit Menu</h3>

    <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="nama_menu" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="{{ $menu->nama_menu }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $menu->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga (Rp)</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $menu->harga }}" required>
        </div>

        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-control" id="kategori" name="kategori">
                <option value="makanan" {{ $menu->kategori == 'makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="minuman" {{ $menu->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="{{ old('stok', $menu->stok ?? 0) }}" required>
        </div>

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
            @if($menu->gambar)
                <p class="mt-2"><img src="{{ asset('storage/' . $menu->gambar) }}" width="100"></p>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.menu') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
