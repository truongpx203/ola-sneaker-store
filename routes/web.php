<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\client\Account;
use App\Http\Controllers\client\AccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('client.home');
})->name('/');

Route::get('/shop', function () {
    return view('client.shop');
})->name('/shop');

Route::get('/blog', function () {
    return view('client.blog');
})->name('/blog');
Route::get('/product-detail', function () {
    return view('client.product-details');
})->name('product-detail');
Route::get('/product-details', function () {
    return view('client.product-details');
})->name('/product-detail');
// ...

Route::get('page-not-found', function () {
    return view('client.page-not-found');
});
Route::get('contact', function () {
    return view('client.contact');
});
Route::get('shop-wishlist', function () {
    return view('client.shop-wishlist');
});
Route::get('shop-cart', function () {
    return view('client.shop-cart');
});
Route::get('shop-checkout', function () {
    return view('client.shop-checkout');
});
Route::get('order-details', function () {
    return view('client.order-details');
})->name('order-details');

Route::get('tt-thanhcong', function () {
    return view('client.tt-thanh-cong');
});


// Admin

Route::get('admin', function() {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
// Client

Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::get('/verify-account/{email}', [AccountController::class, 'verify_account'])->name('verify.account');
Route::post('/login', [AccountController::class, 'loginSubmit'])->name('loginSubmit');

Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/register', [AccountController::class, 'registerSubmit'])->name('registerSubmit');

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');        

Route::get('/account', [AccountController::class, 'account'])
    ->name('account')
    ->middleware('auth');