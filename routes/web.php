<?php

use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\client\Account;
use App\Http\Controllers\client\AccountController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\VariantController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\CartController;

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

Route::get('/blog', function () {
    return view('client.blog');
})->name('/blog');
Route::get('/product-detail', function () {
    return view('client.product-details');
})->name('product-detail');
// ...

Route::get('page-not-found', function () {
    return view('client.page-not-found');
});
Route::get('contact', function () {
    return view('client.contact');
})->name('contact');
Route::get('shop-wishlist', function () {
    return view('client.shop-wishlist');
});
// Route::get('shop-cart', function () {
//     return view('client.shop-cart');
// });
Route::get('shop-checkout', function () {
    return view('client.shop-checkout');
});
Route::get('order-details', function () {
    return view('client.order-details');
})->name('order-details');

Route::get('tt-thanhcong', function () {
    return view('client.tt-thanh-cong');
});
Route::get('check-outCart', function () {
    return view('client.shop-checkout');
});
Route::get('shop-wishlist', function () {
    return view('client.shop-wishlist');
});
Route::get('shop-compare', function () {
    return view('client.shop-compare');
});
Route::get('account', function () {
    return view('client.account');
});
Route::get('tt-thanh-cong', function () {
    return view('client.tt-thanh-cong');
});


// Admin  
Route::middleware(CheckRole::class)->prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{id}/show', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Route quản lý sản phẩm
    Route::prefix('products')
        ->as('products.')
        ->group(function () {
            Route::get('/',                     [ProductController::class, 'index'])->name('index');
            Route::get('/create',               [ProductController::class, 'create'])->name('create');
            Route::post('/store',               [ProductController::class, 'store'])->name('store');
            Route::get('/show/{product}',       [ProductController::class, 'show'])->name('show');
            Route::get('{product}/edit',        [ProductController::class, 'edit'])->name('edit');
            Route::put('{product}/update',      [ProductController::class, 'update'])->name('update');
            Route::delete('{product}/destroy',  [ProductController::class, 'destroy'])->name('destroy');
        });

    // Route quản lý biến thể sản phẩm
    Route::prefix('variants')
        ->as('variants.')
        ->group(function () {
            Route::get('/',                     [VariantController::class, 'index'])->name('index');
            Route::get('/show/{variant}',       [VariantController::class, 'show'])->name('show');
            Route::get('{variant}/edit',        [VariantController::class, 'edit'])->name('edit');
            Route::put('{variant}/update',      [VariantController::class, 'update'])->name('update');
            Route::delete('{variant}/destroy',  [VariantController::class, 'destroy'])->name('destroy');
        });


    // Route quản lý kích thước sản phẩm
    Route::prefix('productsize')
        ->as('productsize.')
        ->group(function () {
            Route::get('/',                     [ProductSizeController::class, 'index'])->name('index');
            Route::get('/create',               [ProductSizeController::class, 'create'])->name('create');
            Route::post('/store',               [ProductSizeController::class, 'store'])->name('store');
            Route::get('/edit/{id}',            [ProductSizeController::class, 'edit'])->name('edit');
            Route::put('/update/{id}',          [ProductSizeController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',       [ProductSizeController::class, 'destroy'])->name('destroy');
        });

    // bills
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/{id}', [BillController::class, 'show'])->name('bills.show');
    Route::post('/bills/{id}/update-status', [BillController::class, 'updateStatus'])->name('bills.updateStatus');
});



// Client

Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::get('/verify-account/{email}', [AccountController::class, 'verify_account'])->name('verify.account');
Route::post('/login', [AccountController::class, 'loginSubmit'])->name('loginSubmit');

Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/register', [AccountController::class, 'registerSubmit'])->name('registerSubmit');

Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
Route::post('/forgot-password', [AccountController::class, 'check_forgot_password']);

Route::get('/reset-password/{token}', [AccountController::class, 'reset_password'])->name('account.reset_password');
Route::post('/reset-password/{token}', [AccountController::class, 'check_reset_password']);

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');

Route::get('/account', [AccountController::class, 'account'])
    ->name('account')
    ->middleware('auth');


// show sp mới limit8

Route::get('/', [ClientProductController::class, 'showNewProducts'])->name('/');

Route::get('/product/{id}', [ClientProductController::class, 'show'])->name('product-detail');

Route::get('/', [ClientProductController::class, 'showNewProducts'])->name('/');
// chi tiết sp
Route::get('/product/{id}', [ClientProductController::class, 'show'])->name('product-detail');
// trang sản phẩm (có bộ lọc)
Route::get('/shop/filter', [ClientProductController::class, 'filterProducts'])->name('shop.filter');
Route::get('/shop/page', [ClientProductController::class, 'paginateProducts'])->name('shop.paginate');
Route::get('/shop/filter/price', [ClientProductController::class, 'filterByPrice'])->name('shop.filter.price');
//trang giỏ hàng
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear'); 
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/voucher', [CartController::class, 'applyVoucher'])->name('cart.voucher');













Route::get('show-bill-item', function () {
    return view('admin.bills.show-bill-item');
});
