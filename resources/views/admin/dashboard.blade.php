<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Kedai Nawasena</title>
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
        .btn-logout {
            background-color: #ff3333;
            color: white;
        }
        .btn-logout:hover {
            background-color: #cc0000;
        }
        .card-summary {
            border: none;
            border-radius: 10px;
            background-color: #fff3cd;
            color: #cc0000;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .card-summary h3 {
            font-size: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Admin Nawasena</a>
        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="text-danger mb-4">👩‍🍳 Selamat datang, {{ Auth::user()->name }}</h3>
    <div class="mb-4">
        <a href="{{ route('admin.menu') }}" class="btn btn-warning me-2">🍽️ Kelola Menu</a>
        <a href="{{ route('admin.orders') }}" class="btn btn-primary me-2">📦 Kelola Pesanan</a>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card card-summary p-4">
                <h5>Total Menu</h5>
                <h3>{{ $totalMenu }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-summary p-4">
                <h5>Total Pelanggan</h5>
                <h3>{{ $totalPelanggan }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-summary p-4">
                <h5>Total Pesanan</h5>
                <h3>{{ $totalOrder }}</h3>
            </div>
        </div>
    </div>

    <h4 class="text-dark mb-3">📋 Daftar Pesanan Terbaru</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-warning">
            <tr>
                <th>#</th>
                <th>Nama Pelanggan</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user->name }}</td>
                <td>
                    Rp {{ number_format(
                        $order->details->sum(function($item) {
                            return $item->harga * $item->jumlah;
                        })
                    ) }}
                </td>
                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada pesanan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
