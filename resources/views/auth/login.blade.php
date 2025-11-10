<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AGRI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 login-bg">
        <div class="card login-card text-center p-5 shadow-lg">
            <img src="{{ asset('images/logo-kasir.png') }}" alt="" class="login-logo mx-auto mb-3">

            <form id="loginForm">
                <div class="mb-3 text-start">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control custom-input" placeholder="Username" required>
                </div>

                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control custom-input" placeholder="Password" required>
                </div>

               <button type="submit" class="btn btn-custom w-100 mt-3">sign in</button>

            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/auth/login.js') }}"></script>
</body>
</html>
