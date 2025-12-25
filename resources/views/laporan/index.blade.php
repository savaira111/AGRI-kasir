@extends('layout.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4">Laporan Penjualan</h3>

    {{-- FORM FILTER --}}
    <div class="card shadow-sm mb-4" style="background:#D4EDC9;">
        <div class="card-body">
            <form action="{{ route('laporan.generate') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label class="fw-bold">Masukkan periode bulanan</label>
                    <input type="number" min="1" max="12" name="bulan" class="form-control"
                           placeholder="Bulan (1-12)" required>
                </div>

                <div class="col-md-4">
                    <label class="fw-bold">Masukkan periode tahunan</label>
                    <input type="number" name="tahun" class="form-control"
                           placeholder="Tahun" required>
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

                    @php
                        $list = $laporanList->sortByDesc('id_laporan');

                        $laporanPeriode = null;

                        if ($isGenerated && isset($filterBulan) && isset($filterTahun)) {
                            $periodeCari = \Carbon\Carbon::createFromDate($filterTahun, $filterBulan, 1)->format('F Y');
                            $laporanPeriode = $list->firstWhere('periode', $periodeCari);
                        }
                    @endphp

                    {{-- ============================= --}}
                    {{--   MODE: USER HABIS GENERATE    --}}
                    {{-- ============================= --}}
                    @if($isGenerated)

                        {{-- Laporan tidak ditemukan --}}
                        @if (!$laporanPeriode)
                            <tr>
                                <td colspan="5" class="text-center text-danger fw-bold py-4">
                                    Tidak ada data laporan.
                                </td>
                            </tr>

                        {{-- Ada laporan tetapi transaksi = 0 --}}
                        @elseif ($laporanPeriode->total_transaksi == 0)
                            <tr>
                                <td colspan="5" class="text-center text-danger fw-bold py-4">
                                    Tidak ada data laporan.
                                </td>
                            </tr>

                        {{-- Ada laporan valid --}}
                        @else
                            <tr>
                                <td class="text-center">1</td>
                                <td class="text-center">{{ $laporanPeriode->periode }}</td>
                                <td>Rp {{ number_format($laporanPeriode->total_penjualan, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $laporanPeriode->total_transaksi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('laporan.exportPdf', $laporanPeriode->id_laporan) }}"
                                       class="btn btn-danger btn-sm rounded-pill">
                                        Export PDF
                                    </a>
                                </td>
                            </tr>
                        @endif

                    {{-- ============================= --}}
                    {{--   MODE: BELUM GENERATE         --}}
                    {{-- ============================= --}}
                    @else

                        @forelse ($list as $i => $l)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td class="text-center">{{ $l->periode }}</td>
                                <td>Rp {{ number_format($l->total_penjualan, 0, ',', '.') }}</td>
                                <td class="text-center">{{ $l->total_transaksi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('laporan.exportPdf', $l->id_laporan) }}"
                                       class="btn btn-danger btn-sm rounded-pill">
                                        Export PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-danger py-4">
                                    Tidak ada data laporan.
                                </td>
                            </tr>
                        @endforelse

                    @endif

                </tbody>

            </table>
        </div>
    </div>

  
</div>

@endsection