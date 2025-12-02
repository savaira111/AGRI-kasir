<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - AGRI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Rubik', sans-serif; background-color: #f4f7f4;">

<div class="container py-5">
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('produk.index') }}" class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center me-3"
           style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left-short fs-4 text-dark"></i>
        </a>
        <h4 class="m-0 fw-bold">Tambah Data Produk</h4>
    </div>

    <div class="card shadow-sm border-0 p-4" style="background-color: #C0EBA6; border-radius: 15px;">
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="kode_produk" class="form-label fw-semibold">Kode Produk</label>
                <input type="text" id="kode_produk" name="kode_produk" class="form-control" value="{{ $kodeOtomatis }}" readonly>
            </div>

            <div class="mb-3">
                <label for="tanggal_input" class="form-label fw-semibold">Tanggal Input</label>
                <input type="date" id="tanggal_input" name="tanggal_input" class="form-control"
                       value="{{ old('tanggal_input', date('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control" placeholder="Isi nama produk" value="{{ old('nama_produk') }}" required>
            </div>

            <div class="mb-3">
                <label for="nama_pemasok" class="form-label fw-semibold">Nama Pemasok</label>
                <input type="text" id="nama_pemasok" name="nama_pemasok" class="form-control" placeholder="Isi nama pemasok" value="{{ old('nama_pemasok') }}" required>
            </div>

            <!-- Kategori Produk (Input biasa) -->
            <div class="mb-3">
                <label for="kategori_produk" class="form-label fw-semibold">Kategori Produk</label>
                <input type="text" id="kategori_produk" name="kategori_produk" class="form-control" placeholder="Isi kategori produk" value="{{ old('kategori_produk') }}">
            </div>

            <div class="mb-3">
                <label for="stok_produk" class="form-label fw-semibold">Stok</label>
                <input type="number" id="stok_produk" name="stok_produk" class="form-control" placeholder="Isi stok produk" value="{{ old('stok_produk') }}" min="0" required>
            </div>

            <!-- Satuan Produk (Input biasa) -->
            <div class="mb-3">
                <label for="satuan_produk" class="form-label fw-semibold">Satuan</label>
                <input type="text" id="satuan_produk" name="satuan_produk" class="form-control" placeholder="Isi satuan produk" value="{{ old('satuan_produk') }}">
            </div>

            <div class="mb-3">
                <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                <input type="number" id="harga_jual" name="harga_jual" class="form-control" placeholder="Isi harga jual produk" value="{{ old('harga_jual') }}" min="0" required>
            </div>

            <div class="mb-3">
                <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                <input type="number" id="harga_beli" name="harga_beli" class="form-control" placeholder="Isi harga beli produk" value="{{ old('harga_beli') }}" min="0" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label fw-semibold">Deskripsi</label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="2" class="form-control" placeholder="Isi deskripsi produk">{{ old('deskripsi_produk') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tanggal_kadaluarsa" class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control" value="{{ old('tanggal_kadaluarsa') }}" required>
            </div>

            <div class="mb-3">
                <label for="foto_produk" class="form-label fw-semibold">Pilih Foto Produk</label>
                <input type="file" id="foto_produk" name="foto_produk" class="form-control">
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn fw-bold px-4" style="background-color: #FCCD2A; color: black; border-radius: 12px;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
