@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Edit Kategori</h2>
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

            <!-- Form Edit Kategori -->
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')


                <!-- Nama Kategori -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}" required>
                </div>

               <!-- Tombol Simpan dan Kembali -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
