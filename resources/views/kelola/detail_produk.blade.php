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
        body {
            font-family: 'Rubik', sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            background-color: #C0EBA6;
        }
        .product-img {
            width: 100%;
            max-width: 500px;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <!-- Gambar Produk -->
        <div class="col-md-6 d-flex justify-content-center mb-4 mb-md-0">
            @if($produk->foto_produk && file_exists(storage_path('app/public/' . $produk->foto_produk)))
                <img src="{{ asset('storage/'.$produk->foto_produk) }}" alt="{{ $produk->nama_produk }}" class="product-img shadow">
            @else
                <img src="{{ asset('image/default.png') }}" alt="Default Image" class="product-img shadow">
            @endif
        </div>

        <!-- Card Detail -->
        <div class="col-md-6">
            <div class="card p-4 shadow">
                <!-- Tombol Back (hanya icon) -->
                <a href="{{ route('produk.index') }}" 
                class="btn btn-light position-absolute top-0 start-0 m-3 p-2 rounded-circle shadow">
                    <i class="bi bi-arrow-left"></i>
                </a>


                <!-- Detail Produk -->
                <div class="mb-2"><strong>Kode Produk:</strong> {{ $produk->kode_produk }}</div>
                <div class="mb-2"><strong>Nama Produk:</strong> {{ $produk->nama_produk }}</div>
                <div class="mb-2"><strong>Nama Pemasok:</strong> {{ $produk->nama_pemasok->nama ?? '-' }}</div>
                <div class="mb-2"><strong>Kategori:</strong> {{ $produk->kategori->nama ?? '-' }}</div>
                <div class="mb-2"><strong>Stok:</strong> {{ $produk->stok }}</div>
                <div class="mb-2"><strong>Satuan:</strong> {{ $produk->satuan }}</div>
                <div class="mb-2"><strong>Harga Jual:</strong> Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</div>
                <div class="mb-2"><strong>Harga Beli:</strong> Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</div>
                <div class="mb-2"><strong>Deskripsi:</strong> {{ $produk->deskripsi ?? '-' }}</div>
                <div class="mb-2"><strong>Tanggal Input:</strong> {{ $produk->tanggal_input }}</div>
                <div class="mb-2"><strong>Tanggal Kadaluarsa:</strong> {{ $produk->tanggal_kadaluarsa }}</div>

                <!-- Tombol Edit -->
                <a href="{{ route('produk.edit', $produk->id_produk) }}" class="btn btn-warning mt-3 w-100">Edit Produk</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
