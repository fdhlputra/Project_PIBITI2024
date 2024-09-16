<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/categories', function () {
    return view('category.index');
});

Route::get('/categories/create', function () {
    return view('category.create');
});

Route::get('/categories/edit', function () {
    return view('category.edit');
});

Route::get('/products', function () {
    return view('product.index');
});

Route::get('/products/create', function () {
    return view('product.create');
});

Route::get('/products/edit', function () {
    return view('product.edit');
});

/* Page Users */
Route::get('/users', function () {
    return view('users.index');
});

Route::get('/users/create', function () {
    return view('users.create');
});

Route::get('/users/edit', function () {
    return view('users.edit');
});

Route::get('/login', function () {
    return view('login');
});

/* Profile Page */
Route::get('/profile', function () {
    return view('profile.index');
});

/* Order Page */
Route::get('/order', function () {
    return view('order.index');
});


