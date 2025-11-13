<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - AGRI</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Rubik', sans-serif; background-color: #f4f7f4;">

<div class="container py-5">
    <div class="d-flex align-items-center mb-3">
        <!-- Tombol kembali -->
        <a href="/produk" class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center me-3"
           style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left-short fs-4 text-dark"></i>
        </a>
        <h4 class="m-0 fw-bold">Halaman Edit data produk</h4>
    </div>

    <!-- Card form -->
    <div class="card shadow-sm border-0 p-4" style="background-color: #C0EBA6; border-radius: 15px;">
        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="kode_produk" class="form-label fw-semibold">Kode produk</label>
                <input type="text" id="kode_produk" name="kode_produk" class="form-control" 
                       value="{{ $produk->kode_produk }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">Nama produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" 
                       value="{{ $produk->nama_produk }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_pemasok" class="form-label fw-semibold">Nama pemasok</label>
                <input type="text" id="nama_pemasok" name="nama_pemasok" class="form-control" 
                       value="{{ $produk->nama_pemasok }}" required>
            </div>

            <div class="mb-3">
                <label for="kategori_produk" class="form-label fw-semibold">Kategori produk</label>
                <input type="text" id="kategori_produk" name="kategori" class="form-control" 
                       value="{{ $produk->kategori }}" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label fw-semibold">Stok</label>
                <input type="number" id="stok" name="stok" class="form-control" 
                       value="{{ $produk->stok }}" required>
            </div>

            <div class="mb-3">
                <label for="satuan" class="form-label fw-semibold">Satuan</label>
                <input type="text" id="satuan" name="satuan" class="form-control" 
                       value="{{ $produk->satuan }}" required>
            </div>

            <div class="mb-3">
                <label for="harga_jual" class="form-label fw-semibold">Harga jual</label>
                <input type="number" id="harga_jual" name="harga_jual" class="form-control" 
                       value="{{ $produk->harga_jual }}" required>
            </div>

            <div class="mb-3">
                <label for="harga_beli" class="form-label fw-semibold">Harga beli</label>
                <input type="number" id="harga_beli" name="harga_beli" class="form-control" 
                       value="{{ $produk->harga_beli }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi_produk" rows="2" class="form-control">{{ $produk->deskripsi_produk }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal_input" class="form-label fw-semibold">Tanggal input</label>
                <input type="date" id="tanggal_input" name="tanggal_input" class="form-control" 
                       value="{{ $produk->tanggal_input }}" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_kadaluwarsa" class="form-label fw-semibold">Tanggal kadaluarsa</label>
                <input type="date" id="tanggal_kadaluwarsa" name="tanggal_kadaluwarsa" class="form-control" 
                       value="{{ $produk->tanggal_kadaluarsa }}">
            </div>

            <div class="mb-3">
                <label for="foto_produk" class="form-label fw-semibold">Pilih foto produk</label>
                <input type="file" id="foto_produk" name="foto_produk" class="form-control">
                @if ($produk->foto_produk)
                    <div class="mt-2 text-center">
                        <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="Foto Produk" width="100" class="rounded shadow">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn fw-bold px-4" 
                        style="background-color: #FCCD2A; color: black; border-radius: 12px;">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
