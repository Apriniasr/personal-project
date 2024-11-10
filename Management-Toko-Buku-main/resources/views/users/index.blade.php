@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Daftar Pengguna</h2>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah Pengguna -->
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('users.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Pengguna</a>
            </div>

            <!-- Tabel Daftar Pengguna -->
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-1">
                                <!-- Form Edit sebagai Tombol -->
                                <form action="{{ route('users.edit', $user) }}" method="GET">
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                </form>

                                <!-- Form Hapus Pengguna -->
                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
