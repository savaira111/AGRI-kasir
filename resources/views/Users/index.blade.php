@extends('layout.app')

@section('title','Users')

@section('content')

<h4 class="fw-bold mb-4">Users</h4>

{{-- SEARCH + TOMBOL TAMBAH --}}
<div class="d-flex align-items-center mb-4">

    {{-- SEARCH TENGAH --}}
    <div class="flex-grow-1 d-flex justify-content-center">
        <form action="{{ route('users.index') }}" method="GET" style="width:65%;">
            <div class="input-group">
                <span class="input-group-text"
                      style="background:#c8f1b4;border:none;">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text"
                       name="search"
                       value="{{ $search ?? '' }}"
                       class="form-control"
                       placeholder="Search..."
                       style="background:#c8f1b4;border:none;">
            </div>
        </form>
    </div>

    {{-- TOMBOL TAMBAH --}}
    <a href="{{ route('users.create') }}"
       class="btn btn-warning fw-bold text-dark rounded-pill px-4 ms-3">
        <i class="bi bi-plus-circle"></i> Tambah
    </a>

</div>

{{-- TABEL --}}
<div class="table-responsive">
    <table class="table text-center align-middle">

        {{-- HEADER --}}
        <thead>
            <tr style="background:#86b97b;color:#fff;">
                <th>No</th>
                <th class="text-start">Nama</th>
                <th class="text-start">Email</th>
                <th class="text-start">Password</th>
                <th>Aksi</th>
            </tr>
        </thead>

        {{-- ISI --}}
        <tbody>
            @forelse($users as $user)
            <tr style="background:#eaf7e3;">
                <td>{{ $loop->iteration }}</td>
                <td class="text-start">{{ $user->name }}</td>
                <td class="text-start">{{ $user->email }}</td>
                <td class="text-start">
                    <small>{{ $user->password }}</small>
                </td>
                <td>
                    <div class="d-flex justify-content-center gap-1">
                        <a href="{{ route('users.edit',$user->id) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('users.destroy',$user->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus user ini?')"
                                    class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr style="background:#eaf7e3;">
                <td colspan="5">Data user tidak ditemukan</td>
            </tr>
            @endforelse
        </tbody>

    </table>
</div>

@endsection
