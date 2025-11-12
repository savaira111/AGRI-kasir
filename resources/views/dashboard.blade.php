<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard AGRI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Rubik -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="font-family: 'Rubik', sans-serif; background-color: #f4f7f4;">

    <div class="d-flex">

        <!-- 🌿🌿🌿🌿🌿🌿🌿🌿🌿🌿  BAGIAN SIDEBAR  🌿🌿🌿🌿🌿🌿🌿🌿🌿🌿 -->
        <div class="d-flex flex-column justify-content-between" 
             style="width: 250px; height: 100vh; background-color: #C0EBA6; padding: 30px 20px; color: black;">
            
            <!-- Bagian atas sidebar -->
            <div>
                <div class="text-center mb-5">
                    <img src="{{ asset('image/logo-kasir.png') }}" alt="Logo" 
                         style="width: 170px; height: 170px; border-radius: 50%;">
                </div>

                <!-- 🌼 Menu Fitur (diposisikan agak ke tengah) -->
                <ul class="list-unstyled mt-5">
                    <li class="mb-3">

                        <a href="{{ route('kelola.produk') }}" 
                            class="d-block text-black text-decoration-none p-2 rounded"
                            style="background-color: transparent; transition: .3s;"
                            onmouseover="this.style.backgroundColor='#FCCD2A';"
                            onmouseout="this.style.backgroundColor='transparent';">
                            <i class="bi bi-box-seam me-2"></i> Produk
                        </a>
                        </li>


                    

                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           style="background-color: transparent; transition: .3s;"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-people-fill me-2"></i>User
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           style="background-color: transparent; transition: .3s;"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-cart-check-fill me-2"></i> Transaksi Penjualan
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded fw-bold" 
                           style="background-color: #FCCD2A;">
                           <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="#" class="d-block text-black text-decoration-none p-2 rounded"
                           style="background-color: transparent; transition: .3s;"
                           onmouseover="this.style.backgroundColor='#FCCD2A';"
                           onmouseout="this.style.backgroundColor='transparent';">
                           <i class="bi bi-bar-chart-line-fill me-2"></i> Laporan Penjualan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- 🌸 Penanda Halaman -->
            <div class="text-center mb-3" style="color: gray; font-size: 0.9rem;">
                <i class=""></i> Dashboard
            </div>
        </div>
        <!-- 🌿🌿🌿🌿🌿🌿🌿🌿🌿🌿  AKHIR SIDEBAR  🌿🌿🌿🌿🌿🌿🌿🌿🌿🌿 -->


        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
           
            <div class="d-flex justify-content-between align-items-center p-4 rounded"
                 style="background-color: #C0EBA6;">
                <div>
                    <h4 class="fw-bold"  style="font-size:30px;">Selamat Datang, <span style="color:#356b3f;">Owner</span></h4>
                    <p style="margin: 0;">Senang melihatmu kembali di AGRI 🌱</p>
                </div>
                <img src="{{ asset('image/dasboard.png') }}" alt="Owner" style="width: 200px; height: 200px;">
            </div>

            <div class="row mt-4 g-3">
                <div class="col-md-4">
                    <div class="p-3 rounded shadow-sm"
                         style="background-color: white; border-left: 6px solid #6fa36f;">
                        <h6 style="color: #6fa36f;">Total Produk</h6>
                        <h4 class="fw-bold">{{ $totalProduk ?? 128 }}</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded shadow-sm"
                         style="background-color: white; border-left: 6px solid #FCCD2A;">
                        <h6 style="color: #6fa36f;">Total Transaksi</h6>
                        <h4 class="fw-bold">{{ $totalTransaksi ?? 4679 }}</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-3 rounded shadow-sm"
                         style="background-color: white; border-left: 6px solid #6fa36f;">
                        <h6 style="color: #6fa36f;">Pendapatan</h6>
                        <h4 class="fw-bold">Rp{{ $totalPendapatan ?? '12.762.000' }}</h4>
                    </div>
                </div>
            </div>

            <div class="mt-5 bg-white rounded p-4 shadow-sm">
                <h5 class="fw-bold mb-3">Total Revenue</h5>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bootstrap + JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
