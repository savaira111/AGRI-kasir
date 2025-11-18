@extends('layout.app')

@section('content')
<div>
    <!-- Selamat Datang -->
    <div class="d-flex justify-content-between align-items-center p-4 rounded position-relative"
         style="background-color: #C0EBA6;">
        <div>
            <h4 class="fw-bold" style="font-size:30px;">
                Selamat Datang, <span style="color:#356b3f;">Owner</span>
            </h4>
            <p class="mb-0">Senang melihatmu kembali di AGRI 🌱</p>
        </div>

        <div class="position-relative">
            <img src="{{ asset('image/dasboard.png') }}" alt="Dashboard" style="width: 200px; height: 200px; object-fit: cover;">
            <img src="{{ asset('image/profile.png') }}" alt="Owner" 
                 class="position-absolute" 
                 style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 2px solid white; top: -10px; right: -10px;">
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mt-4 g-3">
        <div class="col-md-4">
            <div class="p-3 rounded shadow-sm d-flex flex-column" style="background-color: white; border-left: 6px solid #6fa36f;">
                <h6 class="mb-2" style="color: #6fa36f;">Total Produk</h6>
                <h4 class="fw-bold">{{ $totalProduk ?? 128 }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded shadow-sm d-flex flex-column" style="background-color: white; border-left: 6px solid #FCCD2A;">
                <h6 class="mb-2" style="color: #FCCD2A;">Total Transaksi</h6>
                <h4 class="fw-bold">{{ $totalTransaksi ?? 4679 }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 rounded shadow-sm d-flex flex-column" style="background-color: white; border-left: 6px solid #6fa36f;">
                <h6 class="mb-2" style="color: #6fa36f;">Pendapatan</h6>
                <h4 class="fw-bold">Rp{{ number_format($totalPendapatan ?? 12762000, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    <!-- Chart Revenue -->
    <div class="mt-5 bg-white rounded p-4 shadow-sm">
        <h5 class="fw-bold mb-3">Total Revenue</h5>
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Pendapatan',
            data: [1200000, 1500000, 1000000, 1800000, 2000000, 2200000],
            backgroundColor: 'rgba(96, 163, 111, 0.2)',
            borderColor: '#6fa36f',
            borderWidth: 2,
            fill: true,
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { callback: value => 'Rp' + value.toLocaleString('id-ID') } } }
    }
});
</script>
@endsection
