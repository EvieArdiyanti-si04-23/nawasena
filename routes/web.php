<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// ========================
// Autentikasi
// ========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================
// Pesanan
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('pelanggan.dashboard');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/riwayat', [OrderController::class, 'riwayat'])->name('order.riwayat');

    // Keranjang
    Route::prefix('keranjang')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/tambah', [CartController::class, 'add'])->name('cart.add');
        Route::post('/hapus', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    });
});

// ========================
// Admin
// ========================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Menu
    Route::prefix('menu')->group(function () {
        Route::get('/', [AdminMenuController::class, 'index'])->name('admin.menu');
        Route::get('/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
        Route::post('/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
        Route::get('/edit/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
        Route::post('/update/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
        Route::delete('/delete/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.delete');
    });

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
});
