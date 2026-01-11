<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::get('/products', function () {
        return view('admin.products.index');
    });
    Route::get('/products/create', function () {
        return view('admin.products.create');
    });
    Route::get('/orders', function () {
        return view('admin.orders.index');
    });
    Route::get('/users', function () {
        return view('admin.users.index');
    });
    Route::get('/reviews', function () {
        return view('admin.reviews.index');
    });
});
