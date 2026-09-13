<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;

// Halaman Home (Katalog & Hero Model)
Route::get('/', function () {
    return view('welcome');
});

// Halaman Blog
Route::get('/blog', function () {
    return view('blog');
});

// Halaman Contact & Checkout Form
Route::get('/contact', function () {
    return view('contact');
});

// Route Simpan Order dari Frontend Checkout
Route::post('/simpan-order', [OrderController::class, 'store']);

// Route Admin Auth & Dashboard Login (Username: jekih, Password: deabla)
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Route Manajemen Stok & Produk Admin (Dashboard)
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/stock/{id}', [AdminController::class, 'updateStock'])->name('admin.updateStock');
Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])->name('admin.storeProduct');
Route::delete('/admin/product/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');

// Route Manajemen Pesanan Masuk di Admin (Di arahkan ke AdminController agar sinkron)
Route::post('/admin/order/status/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');
Route::delete('/admin/order/delete/{id}', [AdminController::class, 'deleteOrder'])->name('admin.deleteOrder');

// Cek status pesanan customer
Route::post('/cek-pesanan', [OrderController::class, 'checkOrderStatus'])->name('order.check');