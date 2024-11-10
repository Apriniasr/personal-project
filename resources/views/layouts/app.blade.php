<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Buku</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Toko Buku</h2>
        <nav>
            <a href="{{ route('books.index') }}"><i class="fas fa-book"></i> Buku</a>
            <a href="{{ route('categories.index') }}"><i class="fas fa-list"></i> Kategori</a>
            <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> Pengguna</a>
            <a href="{{ route('sales.index') }}"><i class="fas fa-shopping-cart"></i> Penjualan</a>
            <a href="{{ route('cart.index') }}"><i class="fas fa-shopping-basket"></i> Keranjang</a> <!-- Link ke Keranjang -->
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <header>
            <h1>Selamat Datang di Toko Buku</h1>
            <hr>
        </header>

        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="alert alert-primary text-center" role="alert">
                <p>&copy; 2024 Toko Buku. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
