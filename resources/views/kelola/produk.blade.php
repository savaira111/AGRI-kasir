<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - AGRI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Rubik', sans-serif; background-color: #f4f7f4;">
<div class="d-flex">

    <!-- 🌿 SIDEBAR -->
    <div class="d-flex flex-column justify-content-between"
         style="width: 250px; height: 100vh; background-color: #C0EBA6; padding: 30px 20px; color: black;">
        
        <div>
            <div class="text-center mb-5">
                <img src="{{ asset('image/logo-kasir.png') }}" alt="Logo" 
                     style="width: 170px; height: 170px; border-radius: 50%;">
            </div>

            <ul class="list-unstyled mt-5">
                <li class="mb-3">
                    <a href="{{ route('produk.index') }}" class="d-block text-black text-decoration-none p-2 rounded fw-bold" 
                       style="background-color: #FCCD2A;">
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

        <div class="text-center mb-3" style="color: gray; font-size: 0.9rem;">
            <i class=""></i> Produk
        </div>
    </div>
    <!-- 🌿 END SIDEBAR -->

    <!-- MAIN CONTENT -->
    <div class="flex-grow-1 p-4">

        <!-- 🔍 Search Bar -->
        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="input-group" style="width: 1000px;">
                <span class="input-group-text" style="background-color: #C0EBA6; border: none; border-radius: 20px 0 0 20px;">
                    <i class="bi bi-search" style="color: #333;"></i>
                </span>
                <input type="text" class="form-control" placeholder="Search..." 
                       style="background-color: #C0EBA6; border: none; color: #333;">
                <span class="input-group-text" style="background-color: #C0EBA6; border: none; border-radius: 0 20px 20px 0;">
                    <img src="{{ asset('image/profile.png') }}" alt="Profile"
                         style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
                </span>
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
                            <td>{{ $item->kategori ?? '-' }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->deskripsi_produk}}</td>
                           <!-- BAGIAN AJA YANG DIUBAH, BAGIAN LAIN BIARIN -->
<td>
    <div class="d-flex justify-content-center gap-2">
        <!-- Tombol Edit -->
        <a href="{{ route('produk.edit', $item->id_produk) }}" class="btn btn-sm" style="background-color: #FCCD2A;">
            <i class="bi bi-pencil-fill"></i>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" 
              onsubmit="return confirm('Yakin mau hapus produk ini? 🌿')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm" style="background-color: #FCCD2A;">
                <i class="bi bi-trash3-fill"></i>
            </button>
        </form>

        <!-- Tombol Detail -->
        <button class="btn btn-sm" style="background-color: #FCCD2A;">
            <i class="bi bi-eye-fill"></i>
        </button>
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
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
