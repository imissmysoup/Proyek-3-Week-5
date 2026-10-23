<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk Guest (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Route untuk User yang Sudah Login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Route Role Management
    Route::patch('/admin/users/{user}/role', [RoleController::class, 'update'])
        ->middleware('can:manage-roles')
        ->name('admin.users.role.update');

    // Route Simulasi Stateless Cart
    Route::post('/cart/add', function (Request $request) {
        return response()->json([
            'message' => 'Produk berhasil dihitung pada keranjang stateless.',
            'user' => $request->user()->username,
            'role' => $request->user()->role,
            'payload_received' => $request->all(),
        ]);
    })->middleware('can:use-cart')->name('cart.add.stateless');
});