<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', [ShopController::class, 'index'])->name('home');

// Area khusus tamu (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Area khusus pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Keranjang Belanja
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id_barang}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id_barang}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id_barang}', [CartController::class, 'remove'])->name('cart.remove');
    
    // Checkout & Riwayat
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/history', [OrderController::class, 'history'])->name('history');
});