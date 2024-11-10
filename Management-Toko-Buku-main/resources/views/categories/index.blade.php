@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Daftar Kategori</h2>
        </div>
        <div class="card-body">
            <!-- Tombol Tambah Kategori -->
            <div class="d-flex justify-content-between mb-3">
                <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Kategori</a>
            </div>

            <!-- Tabel Daftar Kategori -->
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-1">

                                <!-- Form Edit sebagai Tombol -->
                                <form action="{{ route('categories.edit', $category) }}" method="GET">
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                </form>

                                <!-- Form Hapus Kategori -->
                                <form action="{{ route('categories.destroy', $category) }}" method="POST">
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
