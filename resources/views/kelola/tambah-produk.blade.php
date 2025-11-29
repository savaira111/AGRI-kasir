<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - AGRI</title>

    <!-- Bootstrap & Icon & Font -->
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

            <!-- Kode Produk Otomatis -->
            <div class="mb-3">
                <label for="kode_produk" class="form-label fw-semibold">Kode Produk</label>
                <input type="text" id="kode_produk" name="kode_produk" class="form-control" value="{{ $kodeOtomatis }}" readonly>
            </div>

            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" class="form-control"
                       placeholder="Isi nama produk" required
                       value="{{ old('nama_produk') }}">
            </div>

            <!-- Nama Pemasok -->
            <div class="mb-3">
                <label for="nama_pemasok" class="form-label fw-semibold">Nama Pemasok</label>
                <input type="text" id="nama_pemasok" name="nama_pemasok" class="form-control"
                       placeholder="Isi nama pemasok" required
                       value="{{ old('nama_pemasok') }}">
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label for="kategori_produk" class="form-label fw-semibold">Kategori</label>
                <input type="text" id="kategori_produk" name="kategori_produk" class="form-control"
                       placeholder="Isi kategori produk" required
                       value="{{ old('kategori_produk') }}">
            </div>

            <!-- Satuan -->
            <div class="mb-3">
                <label for="satuan_produk" class="form-label fw-semibold">Satuan</label>
                <select id="satuan_produk" name="satuan_produk" class="form-select" required>
                    <option value="">-- Pilih Satuan --</option>
                    <option value="Kg" {{ old('satuan_produk') == 'Kg' ? 'selected' : '' }}>Kg</option>
                    <option value="Liter" {{ old('satuan_produk') == 'Liter' ? 'selected' : '' }}>Liter</option>
                    <option value="Pcs" {{ old('satuan_produk') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                    <option value="Pack" {{ old('satuan_produk') == 'Pack' ? 'selected' : '' }}>Pack</option>
                    <option value="Botol" {{ old('satuan_produk') == 'Botol' ? 'selected' : '' }}>Botol</option>
                </select>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label for="stok_produk" class="form-label fw-semibold">Stok</label>
                <input type="number"
                       id="stok_produk"
                       name="stok_produk"
                       class="form-control @error('stok_produk') is-invalid @enderror"
                       placeholder="Isi stok produk"
                       value="{{ old('stok_produk') }}"
                       required>

                @error('stok_produk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Harga Jual -->
            <div class="mb-3">
                <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                <input type="number" id="harga_jual" name="harga_jual" class="form-control"
                       placeholder="Isi harga jual produk" required>
            </div>

            <!-- Harga Beli -->
            <div class="mb-3">
                <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                <input type="number" id="harga_beli" name="harga_beli" class="form-control"
                       placeholder="Isi harga beli produk" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label fw-semibold">Deskripsi</label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="2" class="form-control"
                          placeholder="Isi deskripsi produk">{{ old('deskripsi_produk') }}</textarea>
            </div>

            <!-- Tanggal Kadaluarsa -->
            <div class="mb-3">
                <label for="tanggal_kadaluarsa" class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa"
                       class="form-control" required>
            </div>

            <!-- Foto Produk -->
            <div class="mb-3">
                <label for="foto_produk" class="form-label fw-semibold">Pilih Foto Produk</label>
                <input type="file" id="foto_produk" name="foto_produk" class="form-control" required>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
