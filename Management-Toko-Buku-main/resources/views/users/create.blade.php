@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Tambah Pengguna</h2>
        </div>
        <div class="card-body">
            <!-- Notifikasi Error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Tambah Pengguna -->
            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <!-- Nama Pengguna -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <!-- Email Pengguna -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <!-- Password Pengguna -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="d-flex justify-content-between">
                <a href="{{ route('books.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
