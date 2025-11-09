<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kasir</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container d-flex">
        {{-- Bagian Kiri - Form Login --}}
        <div class="login-box d-flex flex-column justify-content-center align-items-center p-5">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo-kasir.png') }}" alt="Logo Kasir" class="logo mb-3">
                <h2 class="fw-bold">Login Kasir</h2>
            </div>

            {{-- Form Login --}}
            <form action="{{ route('login.process') }}" method="POST" class="w-100">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <input type="text" id="username" name="username" class="form-control p-2" placeholder="Masukkan username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input type="password" id="password" name="password" class="form-control p-2" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2 py-2 fw-semibold">Login</button>

                {{-- Pesan Error --}}
                @if(session('error'))
                    <p class="text-danger text-center mt-3">{{ session('error') }}</p>
                @endif
            </form>
        </div>

        {{-- Bagian Kanan - Background --}}
        <div class="bg-side w-50 d-none d-md-block">
            <img src="{{ asset('images/bg-login.jpg') }}" alt="Background Login" class="bg-img">
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
