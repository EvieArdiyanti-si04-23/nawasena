<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin - Kedai Nawasena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff8e1; }
        .navbar { background-color: #ffcc00; }
        .navbar-brand { color: #cc0000; font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</nav>

@yield('content')

</body>
</html>
