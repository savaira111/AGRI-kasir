@extends('layout.app')

@section('content')

<div class="d-flex justify-content-center align-items-center mb-4 position-relative">

    <!-- Form Search + Profil dalam satu input-group -->
    <form action="{{ route('transactions.index') }}" method="GET" style="width: 900px;">
        <div class="input-group" style="border-radius: 20px; overflow: hidden;">

            <!-- Icon Search -->
            <span class="input-group-text" style="background-color:#C0EBA6; border:none;">
                <i class="bi bi-search" style="color:#333;"></i>
            </span>

            <!-- Input Search -->
            <input type="text" name="search" class="form-control" placeholder="Search..."
                   value="{{ request('search') }}"
                   style="background-color:#C0EBA6; border:none; color:#333;">

            <!-- Button Profil -->
            <button type="button" id="profileBtn"
                    class="btn"
                    style="background-color:#C0EBA6; border:none; display:flex; align-items:center; justify-content:center;">
                <img src="{{ asset('image/profile.png') }}" alt="Profile"
                     style="width:38px; height:38px; border-radius:50%; object-fit:cover; border:2px solid white;">
            </button>
        </div>
    </form>

    <!-- Dropdown Menu -->
    <div id="profileMenu"
         style="
            display:none;
            position:absolute;
            top:55px;
            right:0;
            background:#A4D792;
            padding:18px 20px;
            width:170px;
            border-radius:20px;
            text-align:center;
            box-shadow:0 4px 10px rgba(0,0,0,0.15);
            z-index:1000;
         ">
        
        <div class="d-flex align-items-center mb-3">
            <img src='{{ asset("image/profile.png") }}'
                 style="width:45px;height:45px;border-radius:50%;margin-right:10px;border:2px solid white;">
            <span style="font-weight:600; font-size:16px;">{{ auth()->user()->name }}</span>
        </div>

        <button onclick="openLogoutModal()" 
                style="
                    background:#e8ffe7;
                    border:none;
                    width:100%;
                    padding:10px;
                    border-radius:12px;
                    font-weight:600;
                ">
            <i class="fa-solid fa-right-from-bracket me-1"></i> Log Out
        </button>
    </div>
</div>

<div class="container mt-4">

    <!-- Judul Halaman -->
    <h3 class="mb-4">Daftar Transaksi</h3>

    <!-- Tombol Tambah -->
    <a href="{{ route('transactions.create') }}" class="btn btn-warning mb-3">
        <i class="bi bi-plus-circle me-1"></i> Tambah
    </a>

    <!-- Card Tabel -->
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped mb-0 text-center align-middle">
                <thead style="background-color:#7FB176; color:#fafafa;">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Total Harga</th>
                        <th>Metode Bayar</th>
                        <th>Kasir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksi as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($t->metode_pembayaran) }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td>
                            <a href="{{ route('transactions.show', $t->id) }}"
                               class="btn btn-sm" style="background-color:#FCCD2A;">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted">Tidak ada data transaksi 🌱</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

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
        <h5 class="fw-bold" style="font-size:20px;">Apakah anda yakin akan Log out?</h5>

        <div class="d-flex justify-content-between mt-4">
            <button class="btn w-50 me-2"
                    onclick="closeLogoutModal()"
                    style="
                        background:#E74C3C;
                        color:white;
                        border:none;
                        padding:12px;
                        font-weight:600;
                        border-radius:12px;
                    ">
                Tidak
            </button>

            <form action="{{ route('logout') }}" method="POST" class="w-50">
                @csrf
                <button class="btn w-100"
                        style="
                            background:#F1C40F;
                            border:none;
                            padding:12px;
                            font-weight:600;
                            border-radius:12px;
                        ">
                    Ya
                </button>
            </form>
        </div>
    </div>
</div>

<!-- JS: Dropdown Toggle + Logout Modal -->
<script>
function toggleProfileMenu() {
    let menu = document.getElementById('profileMenu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

document.getElementById('profileBtn').addEventListener('click', function(e){
    e.stopPropagation();
    toggleProfileMenu();
});

document.addEventListener('click', function(){
    document.getElementById('profileMenu').style.display = 'none';
});

function openLogoutModal() {
    document.getElementById('logoutModal').style.display = 'flex';
}

function closeLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}
</script>

@endsection
