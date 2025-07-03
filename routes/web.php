<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name ('contact');

Route::get('/decoration', function () {
    return view('decoration');
})->name('decoration');

Route::get('/products', [ProductController::class, 'showCatalog'])->name('products');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/invoice/{id}', [CheckoutController::class, 'showInvoice'])->name('invoice.show');
    Route::get('/orders', [OrderController::class, 'userOrders'])->name('orders.user')->middleware('auth');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('admin/kategori', CategoryController::class);
    Route::resource('admin/product', ProductController::class);
    Route::get('/admin/pesanan', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::put('/admin/orders/{id}', [OrderController::class, 'update'])->name('admin.orders.update');
});


require __DIR__.'/auth.php';