@extends('layout.app')

@section('content')

<!-- 🔍 Search Bar + Profil -->
<div class="d-flex justify-content-center align-items-center mb-4 position-relative">
    <form action="{{ route('produk.index') }}" method="GET" style="width: 1000px;">
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
            <button type="button" onclick="toggleProfileMenu()"
                    class="btn"
                    style="background-color:#C0EBA6; border:none; display:flex; align-items:center; justify-content:center;">
                <img src="{{ asset('image/profile.png') }}" alt="Profile"
                     style="width:35px; height:35px; border-radius:50%; object-fit:cover; border:2px solid white;">
            </button>
        </div>
    </form>

    <!-- Dropdown Profil -->
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
            <span style="font-weight:600; font-size:16px;">Admin</span>
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

<!-- 🟡 Tombol Tambah -->
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('produk.create') }}" 
       class="btn btn-warning fw-bold d-flex align-items-center"
       style="color: #000000; font-family: 'Rubik', sans-serif; border-radius: 12px;">
        <i class="bi bi-plus-circle me-1"></i> Tambah
    </a>
</div>

<!-- 🧾 Tabel Produk -->
<div class="mt-4 bg-light p-3 rounded shadow-sm">
    <table class="table table-bordered text-center align-middle" style="background-color: #C0EBA6;">
        <thead>
            <tr>
                <th style="background-color: #7FB176; color: #fafafa;">No</th>
                <th style="background-color: #7FB176; color: #fafafa;">Kode Produk</th>
                <th style="background-color: #7FB176; color: #fafafa;">Nama Produk</th>
                <th style="background-color: #7FB176; color: #fafafa;">Nama Pemasok</th>
                <th style="background-color: #7FB176; color: #fafafa;">Kategori</th>
                <th style="background-color: #7FB176; color: #fafafa;">Stok</th>
                <th style="background-color: #7FB176; color: #fafafa;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_produk ?? '-' }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->nama_pemasok ?? '-' }}</td>
                    <td>{{ $item->kategori_produk ?? '-' }}</td>
                    <td>
                        <span class="{{ $item->stok_produk < 3 ? 'text-danger fw-bold' : '' }}">
                            {{ $item->stok_produk > 0 ? $item->stok_produk : 0 }}
                        </span>
                    </td>

                    <td class="text-center align-middle" style="white-space: nowrap;">
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Edit -->
                            <a href="{{ route('produk.edit', $item->id_produk) }}" 
                               class="btn btn-sm action-edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <!-- Hapus -->
                            <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Yakin mau hapus produk ini? 🌿')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm action-delete">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>

                            <!-- Lihat / Detail -->
                            <a href="/produk/{{ $item->id_produk }}">
                                <button type="button" class="btn btn-sm action-view">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-muted">Belum ada data produk 🌱</td>
                </tr>
            @endforelse
        </tbody>
    </table>
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

<style>
/* Tombol aksi sesuai warna */
.action-edit {
    background-color: #F1C40F; /* kuning */
    color: black;
    transition: 0.2s;
}
.action-edit:hover {
    background-color: #d4b30f;
}

.action-delete {
    background-color: #E74C3C; /* merah */
    color: white;
    transition: 0.2s;
}
.action-delete:hover {
    background-color: #c0392b;
}

.action-view {
    background-color: #3498DB; /* biru */
    color: white;
    transition: 0.2s;
}
.action-view:hover {
    background-color: #2980b9;
}
</style>

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
