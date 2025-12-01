<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { border:1px solid #000; padding:8px; text-align:left; }
        th { background:#d5e8c8; }
        .no-border td { border: none; }
    </style>
</head>
<body>

    <h2>Laporan Penjualan - Periode {{ $laporan->periode }}</h2>

    <p><strong>Dibuat oleh:</strong> Admin</p>
    <p><strong>Tanggal Dicetak:</strong> {{ now()->format('d-m-Y') }}</p>

    {{-- RINGKASAN --}}
    <table>
        <tr>
            <th>Total Penjualan</th>
            <td>Rp {{ number_format($laporan->total_penjualan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Transaksi</th>
            <td>{{ $laporan->total_transaksi }}</td>
        </tr>
    </table>

    {{-- DAFTAR TRANSAKSI --}}
    <h3 style="margin-top:30px;">Daftar Transaksi</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
                <th>Metode Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $i => $t)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal_transaksi)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $t->metode_pembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
