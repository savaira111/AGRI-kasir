<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kasir AGRI')</title>

    <!-- Google Fonts: Rubik -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            font-family: 'Rubik', sans-serif;
            background-color: #FAFDF6;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            min-width: 70px;
            height: 100vh;
            background-color: #C0EBA6;
            padding: 20px;
            display: flex;
            flex-direction: column;
            transition: width 0.3s;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar img.logo {
            width: 170px;
            height: 170px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 30px auto;
            transition: width 0.3s, height 0.3s;
        }

        .sidebar.collapsed img.logo {
            width: 50px;
            height: 50px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            padding-left: 0;
            list-style: none;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: black;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background 0.2s, padding 0.3s;
        }

        .sidebar ul li a i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .sidebar ul li a.active,
        .sidebar ul li a:hover {
            background-color: #FCCD2A;
            font-weight: 500;
        }

        .sidebar.collapsed ul li a span {
            display: none;
        }

        /* Konten utama */
        .main-content {
            flex-grow: 1;
            padding: 20px 30px;
        }

        /* Hamburger */
        .hamburger {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 1.5rem;
            cursor: pointer;
            display: none;
        }

        @media (max-width: 992px) {
            .hamburger {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <img src="{{ asset('image/logo-kasir.png') }}" alt="Logo" class="logo">

            <ul>
                <li>
                    <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
                        <i class="bi bi-box-seam"></i> <span>Produk</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.index') ? 'active' : '' }}">
                        <i class="bi bi-cart-check-fill"></i> <span>Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-bar-chart-line-fill"></i> <span>Laporan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Konten utama -->
        <div class="main-content">
            <!-- Hamburger toggle -->
            <i class="bi bi-list hamburger" id="hamburgerBtn"></i>
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const hamburgerBtn = document.getElementById('hamburgerBtn');

        hamburgerBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>
