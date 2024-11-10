@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Daftar Buku</h2>
        </div>
        <div class="card-body">
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol Tambah Buku dan Form Pencarian -->
            <div class="d-flex justify-content-between mb-3 align-items-center">
                <a href="{{ route('books.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Tambah Buku</a>

                <!-- Form Pencarian -->
                <form action="{{ route('books.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" placeholder="Cari judul buku..." value="{{ request('search') }}" class="form-control form-control-sm me-2" style="width: 200px;">
                    <select name="category_id" class="form-select form-select-sm me-2" style="width: 200px;">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Cari</button>
                </form>
            </div>

            <!-- Tabel Daftar Buku -->
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>Rp{{ number_format($book->price, 0, ',', '.') }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            <!-- Tombol Aksi -->
                            <div class="d-flex gap-1">
                                <!-- Form Edit sebagai Tombol -->
                                <form action="{{ route('books.edit', $book) }}" method="GET">
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                </form>

                                <!-- Form Hapus Buku -->
                                <form action="{{ route('books.destroy', $book) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Hapus</button>
                                </form>

                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-cart-plus"></i> Tambah ke Keranjang</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
