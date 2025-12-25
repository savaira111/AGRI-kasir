@extends('layout.app')

@section('title','Edit User')

@section('content')

<a href="{{ route('users.index') }}" class="btn btn-warning rounded-circle mb-3">
    <i class="bi bi-arrow-left"></i>
</a>

<h4 class="fw-bold mb-4">Edit Data User</h4>

<div class="p-4 rounded"
     style="background:#c8f1b4;">

    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="fw-semibold">Nama</label>
            <input type="text"
                   name="name"
                   value="{{ $user->name }}"
                   class="form-control rounded-pill"
                   required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Email</label>
            <input type="email"
                   name="email"
                   value="{{ $user->email }}"
                   class="form-control rounded-pill"
                   required>
        </div>

        <div class="mb-3">
            <label class="fw-semibold">Password (opsional)</label>
            <input type="password"
                   name="password"
                   class="form-control rounded-pill">
        </div>

        <button class="btn btn-warning rounded-pill px-4">
            Update
        </button>
    </form>
</div>

@endsection
