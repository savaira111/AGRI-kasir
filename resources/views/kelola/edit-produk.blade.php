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

@php
use Carbon\Carbon;
@endphp

<div class="container py-5">
    
    <div class="d-flex align-items-center mb-3">
        <a href="{{ route('produk.index') }}" class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center me-3"
           style="width: 40px; height: 40px;">
            <i class="bi bi-arrow-left-short fs-4 text-dark"></i>
        </a>
        <h4 class="m-0 fw-bold">Edit Data Produk</h4>
    </div>

    <div class="card shadow-sm border-0 p-4" style="background-color: #C0EBA6; border-radius: 15px;">
        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Kode Produk -->
            <div class="mb-3">
                <label for="kode_produk" class="form-label fw-semibold">Kode Produk</label>
                <input type="text" id="kode_produk" name="kode_produk" class="form-control"
                       value="{{ old('kode_produk', $produk->kode_produk) }}" required>
            </div>

            <!-- Tanggal Input -->
            <div class="mb-3">
                <label for="tanggal_input" class="form-label fw-semibold">Tanggal Input</label>
                <input type="date" id="tanggal_input" name="tanggal_input" class="form-control"
                       value="{{ old('tanggal_input', optional(Carbon::parse($produk->tanggal_input))->format('Y-m-d')) }}" required>
            </div>

            <!-- Nama Produk -->
            <div class="mb-3">
                <label for="nama_produk" class="form-label fw-semibold">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk"
                       class="form-control @error('nama_produk') is-invalid @enderror"
                       value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                @error('nama_produk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nama Pemasok -->
            <div class="mb-3">
                <label for="nama_pemasok" class="form-label fw-semibold">Nama Pemasok</label>
                <input type="text" id="nama_pemasok" name="nama_pemasok"
                       class="form-control @error('nama_pemasok') is-invalid @enderror"
                       value="{{ old('nama_pemasok', $produk->nama_pemasok) }}" required>
                @error('nama_pemasok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="mb-3">
                <label for="kategori_produk_dropdown" class="form-label fw-semibold">Kategori Produk</label>
                <select id="kategori_produk_dropdown" name="kategori_produk" class="form-select" required>
                    @php
                        $kategoriList = ['Pupuk', 'Bibit', 'Alat Pertanian', 'Obat', 'Lainnya'];
                    @endphp
                    @foreach($kategoriList as $k)
                        <option value="{{ $k }}" {{ old('kategori_produk', $produk->kategori_produk) == $k ? 'selected' : '' }}>{{ $k }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label for="stok_produk" class="form-label fw-semibold">Stok</label>
                <input type="number" id="stok_produk" name="stok_produk"
                       class="form-control @error('stok_produk') is-invalid @enderror"
                       value="{{ old('stok_produk', $produk->stok_produk) }}" min="0" required>
                @error('stok_produk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Satuan -->
            <div class="mb-3">
                <label for="satuan_produk_dropdown" class="form-label fw-semibold">Satuan</label>
                <select id="satuan_produk_dropdown" name="satuan_produk" class="form-select" required>
                    @php
                        $satuanList = ['Kg', 'Liter', 'Pcs', 'Pack', 'Botol'];
                    @endphp
                    @foreach($satuanList as $s)
                        <option value="{{ $s }}" {{ old('satuan_produk', $produk->satuan_produk) == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Harga Jual -->
            <div class="mb-3">
                <label for="harga_jual" class="form-label fw-semibold">Harga Jual</label>
                <input type="number" step="0.01" id="harga_jual" name="harga_jual"
                       class="form-control @error('harga_jual') is-invalid @enderror"
                       value="{{ old('harga_jual', $produk->harga_jual) }}" min="0" required>
                @error('harga_jual')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Harga Beli -->
            <div class="mb-3">
                <label for="harga_beli" class="form-label fw-semibold">Harga Beli</label>
                <input type="number" step="0.01" id="harga_beli" name="harga_beli"
                       class="form-control @error('harga_beli') is-invalid @enderror"
                       value="{{ old('harga_beli', $produk->harga_beli) }}" min="0" required>
                @error('harga_beli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label for="deskripsi_produk" class="form-label fw-semibold">Deskripsi</label>
                <textarea id="deskripsi_produk" name="deskripsi_produk" rows="2" class="form-control">{{ old('deskripsi_produk', $produk->deskripsi_produk) }}</textarea>
            </div>

            <!-- Tanggal Kadaluarsa -->
            <div class="mb-3">
                <label for="tanggal_kadaluarsa" class="form-label fw-semibold">Tanggal Kadaluarsa</label>
                <input type="date" id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" class="form-control"
                       value="{{ old('tanggal_kadaluarsa', optional(Carbon::parse($produk->tanggal_kadaluarsa))->format('Y-m-d')) }}" required>
            </div>

        
            <!-- Ganti Foto Produk -->
            <div class="mb-3">
                <label for="foto_produk" class="form-label fw-semibold">Ganti Foto Produk (Opsional)</label>
                <input type="file" id="foto_produk" name="foto_produk" class="form-control @error('foto_produk') is-invalid @enderror">
                @error('foto_produk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Foto Lama -->
            @if($produk->foto_produk)
                <div class="mb-3 text-center">
                    <label class="form-label fw-semibold">Foto Produk Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="Foto Produk" width="150" class="rounded shadow mb-2">
                </div>
            @endif

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn fw-bold px-4"
                        style="background-color: #FCCD2A; color: black; border-radius: 12px;">
                    Update
                </button>
            </div>

        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
