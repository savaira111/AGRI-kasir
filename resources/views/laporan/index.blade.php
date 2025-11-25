@extends('layout.app')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4">Laporan Penjualan</h3>

    {{-- FORM FILTER PERIODE --}}
    <div class="card shadow-sm mb-4" style="background:#D4EDC9;">
        <div class="card-body">

            <form action="{{ route('laporan.generate') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="fw-bold">Masukkan periode bulanan</label>
                    <input type="number" min="1" max="12" name="bulan" class="form-control" placeholder="Bulan (1-12)" required>
                </div>
                <div class="col-md-4">
                    <label class="fw-bold">Masukkan periode tahunan</label>
                    <input type="number" name="tahun" class="form-control" placeholder="Tahun" required>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success px-4 rounded-pill">Generate Laporan</button>
                </div>
            </form>

        </div>
    </div>

    {{-- TABEL LAPORAN --}}
    <div class="card shadow-sm mb-4" style="background:#C6E4B5;">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle">
                <thead class="text-center fw-bold" style="background:#AED78B;">
                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Total Penjualan</th>
                        <th>Total Transaksi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $index => $row)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $row->periode }}</td>
                            <td>Rp {{ number_format($row->total_penjualan, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $row->total_transaksi }}</td>
                            <td class="text-center">
                                <a href="{{ route('laporan.exportPdf', $row->id_laporan) }}" class="btn btn-danger btn-sm rounded-pill">
                                    Export PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-danger">Belum ada laporan untuk periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    {{-- RINGKASAN --}}
    <div class="card shadow-sm mb-4" style="background:#D4EDC9;">
        <div class="card-body">
            <h5 class="fw-bold">Total penjualan periode ini :</h5>
            <p class="fs-5">
                Rp 
                {{ number_format($laporan->sum('total_penjualan'), 0, ',', '.') }}
            </p>

            <h5 class="fw-bold mt-3">Total transaksi :</h5>
            <p class="fs-5">{{ $laporan->sum('total_transaksi') }} transaksi</p>
        </div>
    </div>

</div>
@endsection
