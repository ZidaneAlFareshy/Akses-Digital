<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Organization - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 60%; border-radius: 15px; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6 text-white d-flex flex-column justify-content-center align-items-center p-4" style="background: linear-gradient(135deg, #e65f2b, #ff8c61);">
                    <h2>Welcome Back!</h2>
                    <p>To keep connected with us, please login with your personal info. If you do not have an account please register first</p>
                    <a href="{{ url('/register') }}" class="btn btn-outline-light mt-3">Register</a>
                </div>
                <div class="col-md-6 p-5">
                    <h4 class="text-center mb-4">Login</h4>
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="text-center mt-3">Or sign in with:</p>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-light mx-2 bi bi-facebook"></button>
                        <button class="btn btn-light mx-2 bi bi-google"></button>
                        <button class="btn btn-light mx-2 bi bi-twitter-x"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ $errors->first() }}',
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</body>
</html>
