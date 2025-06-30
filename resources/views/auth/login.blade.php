<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Kedai Nawasena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffcc00, #ff3333); /* kuning ke merah */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-nawasena {
            background-color: #ff3333;
            border: none;
            color: #fff;
        }
        .btn-nawasena:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h3 class="text-center mb-4" style="color:#cc0000;">Login to Kedai <b>Nawasena</b></h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-nawasena w-100">Login</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('register') }}" class="text-decoration-none text-danger">Don't have an account yet? Register Now</a>
        </div>
    </div>

</body>
</html>
