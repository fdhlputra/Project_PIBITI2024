<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserSearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* dasboard */
/* Route::get('/', function () {
    return view('dashboard');
})->name('home'); */

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');

    Route::post('/download-image', [UserController::class, 'downloadImage']);
    Route::resource('categories', CategoryController::class);

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users', [UserController::class,'store'])->name('users.store');
    Route::get('/users/edit/{user}', [UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class,'update'])->name('users.update');
    /* Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); */
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('users.destroy');
    /* User Search & Filter */
    Route::get('/users/search', [UserSearchController::class, 'search'])->name('users.search');
    Route::get('/users/filter', [UserSearchController::class, 'filter'])->name('users.filter');
    /* Edit Photo */
    Route::get('users/{user}/editPhoto', [UserController::class, 'editPhoto'])->name('users.editPhoto');
    Route::put('users/{user}/updatePhoto', [UserController::class, 'updatePhoto'])->name('users.updatePhoto');

    /* Profile Page */
    Route::get('/profile', function () {
        return view('profile.index');
    });

    /* Order Page */
    Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])
    ->name('orders.create');

    Route::get('/orders/create/detail/{product}', [OrderController::class, 'createDetail'])
    ->name('orders.create.detail');
    Route::post('/orders/create/detail/{product}', [OrderController::class, 'storeDetail'])
    ->name('orders.store.detail');

    Route::post('/orders/checkout', [OrderController::class, 'checkout'])
    ->name('orders.checkout');

    Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');
});

