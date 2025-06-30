<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pelanggan - Kedai Nawasena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff8e1;
        }
        .navbar {
            background-color: #ffcc00;
        }
        .navbar-brand {
            font-weight: bold;
            color: #cc0000;
        }
        .menu-card {
            border: 1px solid #ffcc00;
            border-radius: 10px;
            transition: 0.3s;
        }
        .menu-card:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .btn-logout {
            background-color: #ff3333;
            color: white;
        }
        .btn-logout:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Kedai Nawasena</a>
            <div class="ms-auto d-flex align-items-center gap-2">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-danger">🛒 Keranjang</a>
                <a href="{{ route('order.riwayat') }}" class="btn btn-secondary">📜 Riwayat Pesanan</a>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3 class="text-danger mb-4">Halo {{ Auth::user()->name }}, Selamat datang!</h3>

        <!-- Makanan -->
        <h4 class="mb-3 text-dark">🍽️ Menu Makanan</h4>
        <div class="row mb-5">
            @forelse($makanan as $menu)
                <div class="col-md-3 mb-4">
                    <div class="card menu-card h-100">
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        @else
                            <div class="p-5 text-center text-muted">Gambar tidak tersedia</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <p class="card-text">{{ $menu->deskripsi }}</p>
                            <p class="text-muted">Stok: {{ $menu->stok }}</p>
                        </div>
                        <div class="card-footer border-0">
                            <strong class="text-danger">Rp {{ number_format($menu->harga) }}</strong>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 80px;">
                                <textarea name="catatan" class="form-control mb-2" placeholder="Catatan khusus (opsional)"></textarea>
                                <button type="submit" class="btn btn-warning w-100">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada makanan tersedia.</p>
            @endforelse
        </div>

        <!-- Minuman -->
        <h4 class="mb-3 text-dark">🥤 Menu Minuman</h4>
        <div class="row">
            @forelse($minuman as $menu)
                <div class="col-md-3 mb-4">
                    <div class="card menu-card h-100">
                        @if($menu->gambar)
                            <img src="{{ asset('storage/' . $menu->gambar) }}" class="card-img-top" style="height: 180px; object-fit: cover;">
                        @else
                            <div class="p-5 text-center text-muted">Gambar tidak tersedia</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <p class="card-text">{{ $menu->deskripsi }}</p>
                            <p class="text-muted">Stok: {{ $menu->stok }}</p>
                        </div>
                        <div class="card-footer border-0">
                            <strong class="text-danger">Rp {{ number_format($menu->harga) }}</strong>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                <input type="number" name="quantity" value="1" min="1" class="form-control mb-2" style="width: 80px;">
                                <textarea name="catatan" class="form-control mb-2" placeholder="Catatan khusus (opsional)"></textarea>
                                <button type="submit" class="btn btn-warning w-100">Tambah ke Keranjang</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">Tidak ada minuman tersedia.</p>
            @endforelse
        </div>
    </div>

</body>
</html>
