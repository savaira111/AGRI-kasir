<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login AGRI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100 login-bg" style="background: url('/image/bg-login.jpg') no-repeat center center/cover;" >
        <div class="card login-card text-center p-5 shadow-lg" style="background:rgba(255, 255, 255, 0.35); backdrop-filter: blur(10px); border-radius: 20px;  width: 380px; border: none;">
            <img src="{{ asset('image/logo-kasir.png') }}" class="mx-auto d-block mb-3"style="width: 130px;">

            <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <div class="mb-3 text-start">
                <label for="username" class="form-label">Email</label>
                <input type="text" name="username" class="form-control custom-input" placeholder="Email" required
                    style="background-color: #6fa36f; border: none; color: white; border-radius: 12px; padding: 12px;">
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control custom-input" placeholder="Password" required
                    style="background-color: #6fa36f; border: none; color: white; border-radius: 12px; padding: 12px;">
            </div>

            <button type="submit" class="btn btn-custom w-50 mt-3"
            style="background-color: #FCCD2A; color: #333; font-weight: 600; border: none; border-radius: 30px; padding: 10px 0; width: 70%;">
            sign in
            </button>

        </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/auth/login.js') }}"></script>
</body>
</html>
