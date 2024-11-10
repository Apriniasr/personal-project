@extends('layouts.app')

@section('content')
<h2>Keranjang Belanja</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('cart') && count(session()->get('cart')) > 0)
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach (session('cart') as $id => $details)
                @php $subtotal = $details['price'] * $details['quantity']; @endphp
                <tr>
                    <td>{{ $details['title'] }}</td>
                    <td>Rp{{ number_format($details['price'], 0, ',', '.') }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol Hapus Item -->
                        <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @php $total += $subtotal; @endphp
            @endforeach
            <tr>
                <td colspan="3" align="right"><strong>Total:</strong></td>
                <td colspan="2">Rp{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('books.index') }}" class="btn btn-secondary">Lanjutkan Belanja</a>

    <form action="{{ route('checkout') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>
@else
    <p>Keranjang belanja Anda kosong.</p>
@endif
@endsection
