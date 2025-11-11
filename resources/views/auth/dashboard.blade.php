<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 220px;
            background-color: #C0EBA6;
            color: white;
            padding-top: 30px;
        }

        .sidebar h4 {
            text-align: center;
            font-weight: 600;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #C0EBA6;
            border-radius: 8px;
        }

        /* Content */
        .content {
            margin-left: 230px;
            padding: 20px;
        }

        .topbar {
            background: linear-gradient(90deg, #C0EBA6);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .welcome-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .welcome-text h5 {
            margin: 0;
            color: #2ecc71;
        }

        .welcome-text p {
            margin: 0;
            color: #555;
        }

        .welcome-img img {
            width: 100px;
        }

        /* Alert Tengah */
        .center-alert {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #27ae60;
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            text-align: center;
            font-weight: 500;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s ease, visibility 0.5s ease;
            z-index: 999;
        }

        .center-alert.show {
            opacity: 1;
            visibility: visible;
        }

        .card-summary {
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        canvas {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h4>Owner </h4>
        <a href="#">Dashboard</a>
        <a href="#">Produk</a>
        <a href="#">Kelola User</a>
        <a href="#">Transaksi Penjualan</a>
        <a href="#">Laporan Penjualan</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="topbar">
            <h4>Dashboard</h4>
        </div>

        <!-- Selamat Datang -->
        <div class="welcome-card">
            <div class="welcome-text">
                <h5>Selamat Datang, {{ Auth::user()->name }}</h5>
                <p>Role: {{ Auth::user()->role }}</p>
            </div>
            <div class="welcome-img">
                <img src="{{ asset('dashboard.png') }}" alt="Owner Image">
            </div>
        </div>

        <!-- Ringkasan -->
        <div class="mt-4">
            <h5>Ringkasan Penjualan</h5>
            <div class="row mt-3">
                <div class="col-md-3">
                    <div class="card p-3 card-summary">
                        <h6>Total Produk</h6>
                        <p>{{ $totalProduk }} Item</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 card-summary">
                        <h6>Total Transaksi</h6>
                        <p>{{ $totalTransaksi }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 card-summary">
                        <h6>Pendapatan Hari Ini</h6>
                        <p>Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-3 card-summary">
                        <h6>Total Pendapatan</h6>
                        <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik -->
        <div class="mt-5">
            <h5>Grafik Pendapatan Bulanan</h5>
            <canvas id="chartPendapatan" height="100"></canvas>
        </div>

    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="center-alert" id="successAlert">
            {{ session('success') }}
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
