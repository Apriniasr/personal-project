```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SaleController;;

Route::get('/', [BookController::class, 'index']);
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('users', UserController::class);
Route::resource('sales', SaleController::class);

Route::get('/cart', [SaleController::class, 'viewCart'])->name('cart.index');
Route::post('/cart/add/{bookId}', [SaleController::class, 'addToCart'])->name('cart.add');
Route::post('/checkout', [SaleController::class, 'checkout'])->name('checkout');
Route::post('cart/remove/{bookId}', [SaleController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/sales/pdf', [SaleController::class, 'exportPdf'])->name('sales.pdf');
