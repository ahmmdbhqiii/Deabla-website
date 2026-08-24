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