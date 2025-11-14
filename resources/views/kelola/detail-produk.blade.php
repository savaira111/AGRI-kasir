<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Rubik Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Rubik', sans-serif; background-color: #f8f9fa; }
        .card { border-radius: 12px; background-color: #C0EBA6; }
        .product-img { width: 563px; height: 472px; object-fit: cover; border-radius: 8px; }
    </style>
</head>
<body>
<div class="container my-4">
    <div class="row justify-content-center">
        <!-- Kiri: Foto Produk -->
        <div class="col-md-6 d-flex justify-content-center mb-3 mb-md-0">
            <img src="{{ asset('storage/'.$produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="product-img">
        </div>

        <!-- Kanan: Card Detail Produk -->
        <div class="col-md-6">
            <div class="card p-3">
                <!-- Tombol Back (icon saja) -->
                <a href="{{ route('produk.index') }}" class="btn btn-light mb-3">
                    <i class="bi bi-arrow-left"></i>
                </a>

                <!-- Detail Produk -->
                <div class="mb-2"><strong>Kode Produk:</strong> <span class="fw-bold text-dark">{{ $produk->kode_produk }}</span></div>
                <div class="mb-2"><strong>Nama Produk:</strong> <span class="fw-bold text-dark">{{ $produk->nama_produk }}</span></div>
                <div class="mb-2"><strong>Nama Pemasok:</strong> <span class="fw-bold text-dark">{{ $produk->nama_pemasok->nama ?? '-' }}</span></div>
                <div class="mb-2"><strong>Kategori:</strong> <span class="fw-bold text-dark">{{ $produk->kategori->nama ?? '-' }}</span></div>
                <div class="mb-2"><strong>Stok:</strong> <span class="fw-bold text-dark">{{ $produk->stok }}</span></div>
                <div class="mb-2"><strong>Satuan:</strong> <span class="fw-bold text-dark">{{ $produk->satuan }}</span></div>
                <div class="mb-2"><strong>Harga Jual:</strong> <span class="fw-bold text-dark">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span></div>
                <div class="mb-2"><strong>Harga Beli:</strong> <span class="fw-bold text-dark">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span></div>
                <div class="mb-2"><strong>Deskripsi:</strong> <span class="fw-bold text-dark">{{ $produk->deskripsi }}</span></div>
                <div class="mb-2"><strong>Tanggal Input:</strong> <span class="fw-bold text-dark">{{ $produk->tanggal_input }}</span></div>
                <div class="mb-2"><strong>Tanggal Kadaluarsa:</strong> <span class="fw-bold text-dark">{{ $produk->tanggal_kadaluarsa }}</span></div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
