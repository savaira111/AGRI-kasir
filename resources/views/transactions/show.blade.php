@extends('layout.app')

@section('content')

   <a href="{{ route('transactions.index') }}"
   class="btn btn-warning rounded-circle d-flex align-items-center justify-content-center me-3"
   style="width: 40px; height: 40px;">
    <i class="bi bi-arrow-left-short fs-4 text-dark"></i>
        </a>

<div class="container py-4">

    <h5 class="fw-bold mb-4">Detail Transaksi</h5>

    {{-- CARD LIST PRODUK --}}
    <div class="p-3 rounded" style="background:#c6f4b1;">

        <h6 class="fw-bold mb-3">List Produk Transaksi</h6>

        <table class="table table-bordered text-center">
            <thead style="background:#86cf6c;">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($transaksi->detailTransaksi as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $item->produk->nama_produk }}</td>
                <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>


    {{-- CARD DETAIL TRANSAKSI --}}
    <div class="p-4 rounded mt-4" style="background:#c6f4b1;">

        <h6 class="fw-bold mb-3">Detail Transaksi</h6>

        <div class="row">
            <div class="col-6">
                <p>Tanggal Transaksi</p>
                <p>Total Transaksi</p>
                <p>Total Bayar</p>
                <p>Kembali</p>
            </div>

            <div class="col-6">
                <p>: {{ $transaksi->tanggal_transaksi }}</p>
                <p>: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                <p>: Rp {{ number_format($transaksi->bayar) }}</p>
                <p>: Rp {{ number_format($transaksi->kembalian) }}</p>
            </div>
        </div>

       <a href="{{ route('transactions.pdf', $transaksi->id) }}" class="btn btn-success">
            <i class="bi bi-file-earmark-pdf"></i> Cetak Struk
        </a>

    </div>

</div>

@endsection
