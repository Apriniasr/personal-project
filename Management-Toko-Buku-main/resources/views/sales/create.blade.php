@extends('layouts.app')

@section('content')
<h2>Tambah Penjualan</h2>
<form action="{{ route('sales.store') }}" method="POST">
    @csrf
    <label>Buku:</label>
    <select name="book_id" required>
        @foreach($books as $book)
        <option value="{{ $book->id }}">{{ $book->title }} - Stok: {{ $book->stock }}</option>
        @endforeach
    </select>

    <label>Jumlah:</label>
    <input type="number" name="quantity" min="1" required>

    <button type="submit" class="btn btn-primary">Tambah ke Penjualan</button>
</form>
@endsection
