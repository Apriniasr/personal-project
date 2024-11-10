@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Riwayat Penjualan</h2>
        </div>
        <div class="card-body">
            <!-- Notifikasi Sukses -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel Riwayat Penjualan -->
            <table class="table table-striped table-hover mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Judul Buku</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <!-- Menampilkan Judul Buku -->
                        <td>
                            @if($sale->book)
                                {{ $sale->book->title }}
                            @else
                                <span class="text-muted">Tidak ada buku</span>
                            @endif
                        </td>

                        <!-- Menampilkan Jumlah, Total Harga, dan Tanggal -->
                        <td>{{ $sale->quantity }}</td>
                        <td>Rp{{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        <td>{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
