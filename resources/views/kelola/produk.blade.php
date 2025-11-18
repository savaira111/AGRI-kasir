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


<!-- 🟡 Tombol Tambah -->
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('produk.create') }}" 
       class="btn btn-warning fw-bold d-flex align-items-center"
       style="color: #000000; font-family: 'Rubik', sans-serif; border-radius: 12px;">
        <i class="bi bi-plus-circle me-1"></i> Tambah
    </a>
</div>

<!-- 🧾 Tabel Produk -->
<div class="mt-4 bg-light p-3 rounded shadow-sm">
    <table class="table table-bordered text-center align-middle" style="background-color: #C0EBA6;">
        <thead>
            <tr>
                <th style="background-color: #7FB176; color: #fafafa;">No</th>
                <th style="background-color: #7FB176; color: #fafafa;">Kode Produk</th>
                <th style="background-color: #7FB176; color: #fafafa;">Nama Produk</th>
                <th style="background-color: #7FB176; color: #fafafa;">Nama Pemasok</th>
                <th style="background-color: #7FB176; color: #fafafa;">Kategori</th>
                <th style="background-color: #7FB176; color: #fafafa;">Stok</th>
                <th style="background-color: #7FB176; color: #fafafa;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->kode_produk ?? '-' }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>{{ $item->nama_pemasok ?? '-' }}</td>
                    <td>{{ $item->kategori_produk ?? '-' }}</td>
                    <td>{{ $item->stok_produk }}</td>

                    <td class="text-center align-middle" style="white-space: nowrap;">
                        <div class="d-flex justify-content-center gap-2">
                            <!-- Tombol Edit -->
                            <a href="{{ route('produk.edit', $item->id_produk) }}" 
                               class="btn btn-sm" style="background-color: #FCCD2A;">
                                <i class="bi bi-pencil-fill"></i>
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('produk.destroy', $item->id_produk) }}" 
                                  method="POST" onsubmit="return confirm('Yakin mau hapus produk ini? 🌿')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background-color: #FCCD2A;">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>

                            <!-- Tombol Detail -->
                            <a href="/produk/{{ $item->id_produk }}">
                                <button type="button" class="btn btn-sm" style="background-color: #FCCD2A;">
                                    <i class="bi bi-eye-fill"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-muted">Belum ada data produk 🌱</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection