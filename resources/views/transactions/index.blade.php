@extends('layout.app')

@section('content')

<!-- 🔍 Search Bar -->
<div class="d-flex justify-content-center align-items-center mb-4">
    <form action="{{ route('produk.index') }}" method="GET" style="width: 1000px;">
        <div class="input-group">
            <span class="input-group-text" 
                  style="background-color: #C0EBA6; border: none; border-radius: 20px 0 0 20px;">
                <i class="bi bi-search" style="color: #333;"></i>
            </span>
            <input type="text" name="search" class="form-control" placeholder="Search..."
                   value="{{ request('search') }}"
                   style="background-color: #C0EBA6; border: none; color: #333;">
            <button class="btn" type="submit" 
                    style="background-color: #C0EBA6; border: none; border-radius: 0 20px 20px 0;">
                <img src="{{ asset('image/profile.png') }}" alt="Profile"
                     style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid white;">
            </button>
        </div>
    </form>
</div>
<div class="container mt-4">

    <!-- Judul Halaman -->
    <h3 class="mb-4">Daftar Transaksi</h3>

    <!-- Tombol Tambah -->
    <a href="{{ route('transactions.create') }}" class="btn btn-warning mb-3">
        + Tambah 
    </a>

    <!-- Card Tabel -->
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-striped mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Total Harga</th>
                        <th class="text-center">Metode Bayar</th>
                        <th class="text-center">Kasir</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transaksi as $t)
                    <tr>
                        <td class="text-center">{{ $t->id }}</td>
                        <td class="text-center">{{ $t->tanggal_transaksi }}</td>
                        <td class="text-center">Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ ucfirst($t->metode_pembayaran) }}</td>
                        <td class="text-center">{{ $t->user->name ?? '-' }}</td>

                        <td class="text-center">

                            <!-- Button Detail -->
                            <a href="{{ route('transactions.show', $t->id) }}" 
                               class="btn btn-sm btn-info text-white">
                                Detail
                            </a>

                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3">
                            Tidak ada data transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
