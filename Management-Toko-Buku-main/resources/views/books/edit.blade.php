@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Edit Buku</h2>
        </div>
        <div class="card-body">
            <!-- Notifikasi jika ada error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Edit Buku -->
            <form action="{{ route('books.update', $book) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Judul Buku -->
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Judul Buku</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title) }}" required>
                </div>

                <!-- Pengarang Buku -->
                <div class="mb-3">
                    <label for="author" class="form-label fw-bold">Pengarang</label>
                    <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author) }}" required>
                </div>

                <!-- Kategori Buku -->
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Harga Buku -->
                <div class="mb-3">
                    <label for="price" class="form-label fw-bold">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $book->price) }}" required>
                    </div>
                </div>

                <!-- Stok Buku -->
                <div class="mb-3">
                    <label for="stock" class="form-label fw-bold">Stok</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $book->stock) }}" required>
                </div>

                <!-- Tombol Simpan dan Kembali -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
