<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Kedai Nawasena')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fffbe6;">

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffcc00;">
        <div class="container">
            <a class="navbar-brand fw-bold text-danger" href="#">Kedai Nawasena</a>
            <div class="ms-auto">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>

</body>
</html>
