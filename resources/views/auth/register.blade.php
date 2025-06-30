<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Kedai Nawasena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffcc00, #ff3333); /* kuning ke merah */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 450px;
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

    <div class="register-card">
        <h3 class="text-center mb-4" style="color:#cc0000;">Kedai <b>Nawasena</b> Registration</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-nawasena w-100">Register Now</button>
        </form>

        <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-decoration-none text-danger">Already have an account? Log in here</a>
        </div>
    </div>

</body>
</html>
