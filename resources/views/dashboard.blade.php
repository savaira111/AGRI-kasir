@extends('layout.app')

@section('content')
<div>
    <!-- Selamat Datang -->
    <div class="d-flex justify-content-between align-items-center p-4 rounded position-relative"
         style="background-color: #C0EBA6;">
        <div>
            <h4 class="fw-bold" style="font-size:30px;">
                Selamat Datang, <span style="color:#356b3f;">Admin</span>
            </h4>
            <p class="mb-0">Senang melihatmu kembali di AGRI 🌱</p>
        </div>

        <div class="position-relative">
            <!-- Dashboard Image Lebih Besar -->
            <img src="{{ asset('image/dasboard.png') }}" alt="Dashboard" style="width: 200px; height: 200px; object-fit: cover;">
           
            <!-- Profil Icon -->
            <img src="{{ asset('image/profile.png') }}" alt="Owner"
                 onclick="toggleProfileMenu()"
                 class="position-absolute" 
                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid white; top: -10px; right: -10px; cursor:pointer;">

            <!-- DROPDOWN PROFIL -->
            <div id="profileMenu"
                 style="
                     display:none;
                     position:absolute;
                     top:50px;
                     right:-10px;
                     background:#A4D792;          
                     padding:18px 20px;
                     border-radius:20px;
                     width:170px;
                     text-align:center;
                     box-shadow:0 4px 10px rgba(0,0,0,0.15);
                     z-index:1000;
                 ">
                
                <!-- Foto & Role -->
                <div class="d-flex align-items-center mb-3">
                    <img src='{{ asset("image/profile.png") }}' 
                         style="width:35px;height:35px;border-radius:50%;margin-right:10px;border:2px solid white;">
                    <span style="font-weight:600; font-size:16px;">Role</span>
                </div>

                <!-- Tombol Logout -->
                <button onclick="openLogoutModal()" 
                        style="
                            background:#e8ffe7;
                            border:none;
                            width:100%;
                            padding:10px;
                            border-radius:12px;
                            font-weight:600;
                        ">
                    <i class="fa-solid fa-right-from-bracket" style="margin-right:5px;"></i>
                    Log Out
                </button>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="d-flex justify-content-center mt-4 flex-wrap gap-3">
        <div class="p-4 rounded shadow-sm text-center" style="background-color: white; width: 250px; border-left: 6px solid #6fa36f;">
            <h6 class="mb-2" style="color: #6fa36f;">Total Produk</h6>
            <h3 class="fw-bold">{{ $totalProduk }}</h3>
        </div>

        <div class="p-4 rounded shadow-sm text-center" style="background-color: white; width: 250px; border-left: 6px solid #FCCD2A;">
            <h6 class="mb-2" style="color: #FCCD2A;">Total Transaksi</h6>
            <h3 class="fw-bold">{{ $totalTransaksi }}</h3>
        </div>

        <div class="p-4 rounded shadow-sm text-center" style="background-color: white; width: 250px; border-left: 6px solid #6fa36f;">
            <h6 class="mb-2" style="color: #6fa36f;">Pendapatan</h6>
            <h3 class="fw-bold">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
        </div>
    </div>

    <!-- Chart Revenue -->
    <div class="mt-5 bg-white rounded p-4 shadow-sm">
        <h5 class="fw-bold mb-3">Total Revenue (6 Bulan Terakhir)</h5>
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('revenueChart').getContext('2d');
const revenueData = @json($revenue);

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
        datasets: [{
            label: 'Pendapatan',
            data: revenueData,
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
        scales: { 
            y: { 
                beginAtZero: true, 
                ticks: { callback: value => 'Rp' + value.toLocaleString('id-ID') } 
            } 
        }
    }
});
</script>

<!-- MODAL LOGOUT -->
<div id="logoutModal"
     style="
         display:none;
         position:fixed;
         inset:0;
         background:rgba(0,0,0,0.4);
         justify-content:center;
         align-items:center;
         z-index:2000;
     ">
    <div style="
        background:white;
        width:330px;
        padding:25px;
        border-radius:25px;
        text-align:center;
        box-shadow:0 6px 18px rgba(0,0,0,0.2);
    ">
        <h5 class="fw-bold" style="font-size:20px;">Apakah anda yakin akan Log out</h5>
        <div class="d-flex justify-content-between mt-4">
            <button class="btn w-50 me-2"
                    onclick="closeLogoutModal()"
                    style="background:#E74C3C;color:white;border:none;padding:12px;font-weight:600;border-radius:12px;">
                Tidak
            </button>
            <form action="{{ route('logout') }}" method="POST" class="w-50">
                @csrf
                <button class="btn w-100"
                        style="background:#F1C40F;border:none;padding:12px;font-weight:600;border-radius:12px;">
                    Ya
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function toggleProfileMenu() {
    let menu = document.getElementById('profileMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'flex';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}
</script>

@endsection
