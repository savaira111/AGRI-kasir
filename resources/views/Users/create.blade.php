@extends('layout.app')

@section('title','Tambah User')

@section('content')

<a href="{{ route('users.index') }}" class="btn btn-warning rounded-circle mb-3">
    <i class="bi bi-arrow-left"></i>
</a>

<h4 class="fw-bold mb-4">Tambah Data User</h4>

<div class="p-4 rounded"
     style="background:#c8f1b4;">

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="fw-semibold">Nama</label>
            <input type="text" name="name" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Email</label>
            <input type="email" name="email" class="form-control rounded-pill" required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Password</label>
            <input type="password" name="password" class="form-control rounded-pill" required>
        </div>

        <button class="btn btn-warning rounded-pill px-4">
            Simpan
        </button>
    </form>
</div>

@endsection
