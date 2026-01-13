<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Session & Middleware Testing
Route::get('/set-session', function () {
    session(['name' => 'Ahmad']);
    return "Session set to Ahmad";
});

Route::get('/get-session', function () {
    return "Session name: " . session('name', 'Not found');
});

Route::get('/secret', function () {
    return "Welcome! You are 18 or older.";
})->middleware(\App\Http\Middleware\CheckAge::class);

// User Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/quiz', function () {
    return view('quiz.index');
});

Route::get('/shop', function () {
    return view('shop.index');
});
Route::get('/styles', function () {
    return view('shop.index'); // Reuse shop for styles demo
});
Route::get('/new-in', function () {
    return view('shop.index'); // Reuse shop for new-in demo
});


Route::get('/shop/{id}', function ($id) {
    return view('shop.show', ['id' => $id]);
});

Route::get('/cart', function () {
    return view('cart.index');
});

Route::get('/checkout', function () {
    return view('checkout.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Category Routes
    Route::resource('categories', CategoryController::class);

    // Product Routes
    Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
    Route::put('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::resource('products', ProductController::class);

    Route::get('/orders', function () {
        return view('admin.orders.index');
    })->name('orders.index');
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');
    Route::get('/reviews', function () {
        return view('admin.reviews.index');
    })->name('reviews.index');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
