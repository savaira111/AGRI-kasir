<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir AGRI')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #FAFDF6;
        }
        a {
            transition: all 0.2s ease;
        }
        .sidebar {
            width: 250px; 
            height: 100vh; 
            background-color: #C0EBA6; 
            padding: 30px 20px; 
            color: black;
        }
        .sidebar a.active {
            background-color: #FCCD2A !important;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- 🌿 Sidebar -->
        <div class="sidebar d-flex flex-column justify-content-between">
            <div>
                <div class="text-center mb-5">
                    <img src="{{ asset('image/logo-kasir.png') }}" alt="Logo" 
                         style="width: 170px; height: 170px; border-radius: 50%;">
                </div>

                <ul class="list-unstyled mt-5">
                    <li class="mb-3">
                        <a href="{{ route('produk.index') }}" 
                           class="d-block text-black text-decoration-none p-2 rounded {{ request()->routeIs('produk.index') ? 'active' : '' }}"
                           onmouseover="if(!this.classList.contains('active')) this.style.backgroundColor='#FCCD2A';"
                           onmouseout="if(!this.classList.contains('active')) this.style.backgroundColor='transparent';">
                           <i class="bi bi-box-seam me-2"></i> Produk
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-people-fill me-2"></i> User
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-cart-check-fill me-2"></i> Transaksi Penjualan
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-bar-chart-line-fill me-2"></i> Laporan Penjualan
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 🌼 Konten utama -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
