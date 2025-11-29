<!-- resources/views/transactions/pdf.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi</title>

    <style>
        body {
            font-family: 'Rubik', sans-serif;
            font-size: 14px;
            color: #000;
        }
        .receipt-box {
            padding: 20px;
            border: 1px solid #000;
        }
        .divider {
            border-top: 2px solid #000;
            margin: 10px 0;
        }
        .logo {
            width: 80px;
            display: block;
            margin: 0 auto 10px auto;
        }
        .text-center {
            text-align: center;
        }
        .d-flex {
            display: flex;
            justify-content: space-between;
        }
        .mb-1 { margin-bottom: 5px; }
        .mb-2 { margin-bottom: 10px; }
        .fw-bold { font-weight: bold; }
    </style>
</head>
<body>

<div class="receipt-box">

    <!-- Logo -->
    <img src="{{ public_path('image/logo-kasir.png') }}" class="logo">

    <div class="divider"></div>

    <!-- Info Transaksi -->
    <div class="d-flex mb-2">
    <span>Tanggal transaksi: {{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d-m-Y') }}</span>
    </div>


    <div class="divider"></div>

    <!-- List Produk -->
    <div class="fw-bold mb-1">List Produk:</div>
    @foreach($transaksi->detailTransaksi as $d)
        <div class="d-flex mb-1">
            <span>{{ $d->jumlah }}x {{ $d->produk->nama_produk }}</span>
            <span>Rp {{ number_format($d->produk->harga_jual, 0, ',', '.') }}</span>
        </div>
    @endforeach

    <div class="divider"></div>

    <!-- Subtotal & Total -->
    <div class="d-flex mb-1">
        <strong>Subtotal:</strong>
        <strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong>
    </div>
    <div class="d-flex mb-2">
        <strong>Total:</strong>
        <strong>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</strong>
    </div>

    <div class="divider"></div>

    <!-- Metode Pembayaran -->
    @if($transaksi->metode_pembayaran == 'cash')
        <div class="d-flex mb-1">
            <strong>Tunai:</strong>
            <strong>Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</strong>
        </div>
        <div class="d-flex mb-2">
            <strong>Kembali:</strong>
            <strong>Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</strong>
        </div>
    @else
        <div class="d-flex mb-2">
            <strong>Metode:</strong>
            <strong>QRIS</strong>
        </div>
    @endif

    <div class="divider"></div>

    <p class="text-center mb-0">Terima kasih telah berbelanja di AGRI!</p>

</div>

</body>
</html>
