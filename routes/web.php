<?php

use App\Livewire\Home;
use App\Livewire\HomePage;
use App\Livewire\Products;
use App\Livewire\ProductDetail;
use App\Livewire\Cart;
use App\Livewire\Checkout;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['role.redirect'])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/products', Products::class)->name('products');
    Route::get('/product/{productId}', ProductDetail::class)->name('product.detail');
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/checkout', Checkout::class)->name('checkout');

    // Profile route (you can create a Livewire component or controller for this)
    Route::get('/profile', function () {
        return view('profile'); // Create this view or use a Livewire component
    })->name('profile');

    // Logout route
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

// Authentication routes (assuming you have these pages)
Route::get('/signin', function () {
    return redirect('/admin/login'); // Redirect to Filament login
})->name('signin');

Route::get('/signup', function () {
    return redirect('/admin/register'); // Redirect to Filament register
})->name('signup');
