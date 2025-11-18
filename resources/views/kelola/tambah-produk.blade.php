<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - AGRI</title>

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
        <h4 class="m-0 fw-bold">Halaman Tambah data produk</h4>
    </div>

    <!-- Card form -->
    <div class="card shadow-sm border-0 p-4" style="background-color: #C0EBA6; border-radius: 15px;">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Kode Produk Otomatis -->
            <div class="mb-3">
                <label for="kode_produk_otomatis" class="form-label fw-semibold">Kode Produk Otomatis</label>
                <input type="text" id="kode_produk_otomatis" name="kode_produk_otomatis" class="form-control" value="{{ $kodeOtomatis }}" readonly>
            </div>

            <!-- Tanggal Input Otomatis -->
            <div class="mb-3">
                <label for="tanggal_input_otomatis" class="form-label fw-semibold">Tanggal Input Otomatis</label>
                <input type="date" id="tanggal_input_otomatis" name="tanggal_input_otomatis" class="form-control" value="{{ date('Y-m-d') }}" readonly>
            </div>

            <!-- Dropdown Kategori -->
            <div class="mb-3">
                <label for="kategori_produk_dropdown" class="form-label fw-semibold">Pilih Kategori</label>
                <select id="kategori_produk_dropdown" name="kategori_produk_dropdown" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Satuan -->
            <div class="mb-3">
                <label for="satuan_produk_dropdown" class="form-label fw-semibold">Pilih Satuan</label>
                <select id="satuan_produk_dropdown" name="satuan_produk_dropdown" class="form-select">
                    <option value="">-- Pilih Satuan --</option>
                    @foreach($satuan as $s)
                        <option value="{{ $s->id }}">{{ $s->nama_satuan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Stok Awal -->
            <div class="mb-3">
                <label for="stok_awal" class="form-label fw-semibold">Stok Awal</label>
                <input type="number" id="stok_awal" name="stok_awal" class="form-control" value="0" readonly>
            </div>

            <!-- Input Lama Tetap Ada -->
            <div class="mb-3">
                <label for="kode_produk" class="form-label fw-semibold">Kode produk</label>
                <input type="text" id="kode_produk" name="kode_produk" class="form-control" placeholder="Isi kode produk" required>
            </div>

            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">Nama produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="Isi nama produk" required>
            </div>

            <div class="mb-3">
                <label for="nama_pemasok" class="form-label fw-semibold">Nama pemasok</label>
                <input type="text" id="nama_pemasok" name="nama_pemasok" class="form-control" placeholder="Isi nama pemasok" required>
            </div>

            <div class="mb-3">
                <label for="kategori_produk" class="form-label fw-semibold">Kategori produk</label>
                <input type="text" id="kategori_produk" name="kategori_produk" class="form-control" placeholder="Isi kategori produk" required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label fw-semibold">Stok</label>
                <input type="number" id="stok_produk" name="stok_produk" class="form-control" placeholder="Isi stok produk" required>
            </div>

            <div class="mb-3">
                <label for="satuan" class="form-label fw-semibold">Satuan</label>
                <input type="text" id="satuan_produk" name="satuan_produk" class="form-control" placeholder="Isi satuan produk" required>
            </div>

            <div class="mb-3">
                <label for="harga_jual" class="form-label fw-semibold">Harga jual</label>
                <input type="number" id="harga_jual" name="harga_jual" class="form-control" placeholder="Isi harga jual produk" required>
            </div>

            <div class="mb-3">
                <label for="harga_beli" class="form-label fw-semibold">Harga beli</label>
                <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Isi harga beli produk" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi_produk" rows="2" class="form-control" placeholder="Isi deskripsi produk"></textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal_input" class="form-label fw-semibold">Tanggal input</label>
                <input type="date" id="tanggal_input" name="tanggal_input" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_kadaluwarsa" class="form-label fw-semibold">Tanggal kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control">
            </div>

            <div class="mb-3">
                <label for="foto_produk" class="form-label fw-semibold">Pilih foto produk</label>
                <input type="file" id="foto_produk" name="foto_produk" class="form-control">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn fw-bold px-4" 
                        style="background-color: #FCCD2A; color: black; border-radius: 12px;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
