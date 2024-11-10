<?php

// app/Http/Controllers/SaleController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Sale;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('book', 'user')->get();
        return view('sales.index', compact('sales'));
    }

    public function show($id)
    {
    // Temukan data penjualan berdasarkan ID
    $sale = Sale::with('book')->findOrFail($id);

    // Return ke view yang menunjukkan detail penjualan (buat view `sales.show` jika diperlukan)
    return view('sales.show', compact('sale'));
    }

    public function addToCart(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);

        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // Jika buku sudah ada di keranjang, tambahkan jumlahnya
        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity']++;
        } else {
            // Jika belum, tambahkan buku ke keranjang
            $cart[$bookId] = [
                "title" => $book->title,
                "price" => $book->price,
                "quantity" => 1
            ];
        }

        // Simpan kembali ke session
        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('sales.cart', compact('cart'));
    }

    // Method untuk menghapus item dari cart
    public function removeFromCart($bookId)
    {
        $cart = session()->get('cart', []);

        // Jika item ada di cart, hapus item tersebut
        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
    $cart = session()->get('cart', []);
    $userId = null; // Pastikan user_id diisi dengan null jika tidak ada autentikasi

    foreach ($cart as $bookId => $details) {
        $book = Book::findOrFail($bookId);

        if ($details['quantity'] > $book->stock) {
            return redirect()->route('cart.index')->withErrors(['Stok tidak mencukupi untuk buku: ' . $book->title]);
        }

        Sale::create([
            'user_id' => $userId, // Pastikan user_id ini diisi dengan null
            'book_id' => $bookId,
            'quantity' => $details['quantity'],
            'total_price' => $details['price'] * $details['quantity'],
        ]);

        $book->decrement('stock', $details['quantity']);
    }

    session()->forget('cart');

    return redirect()->route('sales.index')->with('success', 'Checkout berhasil! Transaksi telah disimpan.');
}

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('sales.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::find($request->book_id);

        if ($request->quantity > $book->stock) {
            return back()->withErrors(['quantity' => 'Jumlah melebihi stok yang tersedia.']);
        }

        $total_price = $book->price * $request->quantity;

        Sale::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
        ]);

        $book->decrement('stock', $request->quantity);

        return redirect()->route('sales.index');
    }
}