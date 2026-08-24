<?php

use Illuminate\Support\Facades\Route;

// Halaman Home (Katalog & Hero Model)
Route::get('/', function () {
    return view('welcome');
});

// Halaman Blog
Route::get('/blog', function () {
    return view('blog');
});

// Halaman Contact & Order
Route::get('/contact', function () {
    return view('contact');
});
use Illuminate\Http\Request;
use App\Models\Order;

Route::post('/simpan-order', function (Request $request) {
    Order::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'product' => $request->product,
        'size' => $request->size,
        'address' => $request->address,
        'payment_method' => $request->payment_method,
    ]);

    return response()->json(['success' => true]);
});