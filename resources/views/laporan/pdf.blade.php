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
    </style>
</head>
<body>

    <h2>Laporan Penjualan - Periode {{ $laporan->periode }}</h2>
    <p><strong>Dibuat oleh:</strong> {{ $laporan->pembuat->name ?? '-' }}</p>
    <p><strong>Tanggal Dicetak:</strong> {{ now()->format('d-m-Y') }}</p>

    <table>
        <tr>
            <th>Total Penjualan</th>
            <td>Rp {{ number_format($laporan->total_penjualan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Total Transaksi</th>
            <td>{{ $laporan->total_transaksi }}</td>
        </tr>
        <tr>
            <th>Total Laba</th>
            <td>Rp {{ number_format($laporan->total_laba, 0, ',', '.') }}</td>
        </tr>
    </table>

</body>
</html>
