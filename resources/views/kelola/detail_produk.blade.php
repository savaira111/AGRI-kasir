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
   
   </style>
</head>
<body>

<!-- 🔙 TOMBOL KEMBALI (pindah ke pojok kiri atas, di luar container) -->
<a href="{{ route('produk.index') }}" 
    class="position-fixed d-flex justify-content-center align-items-center"
    style="
        top: 20px;
        left: 20px;
        width: 45px;
        height: 45px;
        background-color: #FCCD2A;
        border-radius: 50%;
        text-decoration: none;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        color: black;
        z-index: 9999;
    ">
    <i class="bi bi-arrow-left" style="font-size: 24px;"></i>
</a>

<div class="container my-5 position-relative">

    <div class="row justify-content-center align-items-center">

        <!-- Foto produk -->
        <div class="col-md-6 d-flex justify-content-center mb-4 mb-md-0">
            @if($produk->foto_produk)
                <img src="{{ asset('storage/' . $produk->foto_produk) }}" alt="Foto Produk" style="width:600px; border-radius:10px;" class="product-img shadow">
            @else
                <img src="{{ asset('image/default.png') }}" 
                    alt="Default Image" 
                    class="product-img shadow">
            @endif
        </div>

        <!-- Card Detail -->
        <div class="col-md-6">
            <div class="card p-4 shadow">

                <div class="mb-2"><strong>Kode Produk:</strong> {{ $produk->kode_produk }}</div>
                <div class="mb-2"><strong>Nama Produk:</strong> {{ $produk->nama_produk }}</div>
                <div class="mb-2"><strong>Nama Pemasok:</strong> {{ $produk->nama_pemasok }}</div>
                <div class="mb-2"><strong>Kategori:</strong> {{ $produk->kategori_produk }}</div>
                <div class="mb-2"><strong>Stok:</strong> {{ $produk->stok_produk }}</div>
                <div class="mb-2"><strong>Satuan:</strong> {{ $produk->satuan_produk }}</div>
                <div class="mb-2"><strong>Harga Jual:</strong> Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</div>
                <div class="mb-2"><strong>Harga Beli:</strong> Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</div>
                <div class="mb-2"><strong>Deskripsi:</strong> {{ $produk->deskripsi_produk }}</div>
                <div class="mb-2"><strong>Tanggal Input:</strong> {{ $produk->tanggal_input }}</div>
                <div class="mb-2"><strong>Tanggal Kadaluarsa:</strong> {{ $produk->tanggal_kadaluarsa }}</div>

           
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
