<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\client\Account;

use App\Http\Controllers\admin\ContactController as AdminContactController; //12/7/2024
use App\Http\Controllers\admin\BillController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProductReviewController as AdminProductReviewController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\client\AccountController;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\client\ProductController as ClientProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\client\CartController;
use App\Http\Controllers\client\ContactController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\client\ProductReviewController;
use App\Http\Controllers\DateExportController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WishlistController;

use App\Models\Bill;
use App\Models\VoucerHistory;
use App\Models\Voucher;
use Illuminate\Support\Facades\Auth;

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


Route::get('page-not-found', function () {
    return view('client.page-not-found');
})->name('page-not-found');



// Admin
Route::middleware(CheckRole::class)->prefix('admin')->group(function () {


    Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/statistics', [DashboardController::class, 'getStatistics'])->name('statistics');
    Route::post('/statistics/year', [DashboardController::class, 'getStatisticsByYear'])->name('statisticsYear');
    Route::post('/statistics-month', [DashboardController::class, 'statisticsMonth'])->name('statisticsMonth');
    Route::post('/statistics/time-range', [DashboardController::class, 'getStatisticsByTimeRange'])->name('statisticsTimeRange');


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

    // Route quản lý liên hệ (12/7/2024)
    Route::prefix('contacts')
        ->as('contacts.')
        ->group(function () {
            Route::get('/', [AdminContactController::class, 'index'])->name('index'); // Danh sách liên hệ
            Route::get('/{id}', [AdminContactController::class, 'show'])->name('show'); // Xem chi tiết liên hệ
            Route::post('/contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('reply'); //10/12/2024
            // Route::delete('/{id}', [AdminContactController::class, 'destroy'])->name('destroy'); // Xóa liên hệ
        });

    // bills
    Route::get('/bills', [BillController::class, 'index'])->name('bills.index');
    Route::get('/bills/{id}', [BillController::class, 'show'])->name('bills.show');
    Route::post('/bills/{id}/update-status', [BillController::class, 'updateStatus'])->name('bills.updateStatus');

    // reviews
    Route::get('/reviews', [AdminProductReviewController::class, 'index'])->name('reviews.index');
    Route::get('/review/{id}', [AdminProductReviewController::class, 'update']);

    // user
    Route::get('/user', [UserController::class, 'index'])->name('list.user');
    Route::get('/user/{id}', [UserController::class, 'update'])->name('user.updateStatus'); // cập nhật trạng thái
    Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('user.edit');
    Route::put('/edit-user/{id}', [UserController::class, 'updateUser'])->name('user.update');

    Route::prefix('voucher')
        ->as('voucher.')
        ->group(function () {
            Route::get('/',                     [VoucherController::class, 'index'])->name('index');
            Route::get('/create',               [VoucherController::class, 'create'])->name('create');
            Route::post('/store',               [VoucherController::class, 'store'])->name('store');
            Route::get('/edit/{id}',            [VoucherController::class, 'edit'])->name('edit');
            Route::get('/detail/{id}',          [VoucherController::class, 'show'])->name('detail');
            Route::put('/update/{id}',          [VoucherController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',       [VoucherController::class, 'destroy'])->name('destroy');
        });

    Route::prefix('banners')
        ->as('banners.')
        ->group(function () {
            Route::get('/',                     [BannerController::class, 'index'])->name('index');
            Route::get('/create',               [BannerController::class, 'create'])->name('create');
            Route::post('/store',               [BannerController::class, 'store'])->name('store');
            Route::get('/edit/{id}',            [BannerController::class, 'edit'])->name('edit');
            Route::put('/update/{id}',          [BannerController::class, 'update'])->name('update');
            Route::delete('/delete/{banner}',       [BannerController::class, 'destroy'])->name('destroy');
        });

    Route::get('/date-export', [DateExportController::class, 'dateExport']);
    Route::get('/month-export', [DateExportController::class, 'monthExport']);
    Route::get('/year-export', [DateExportController::class, 'yearExport']);
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

Route::middleware(['auth', 'checkStatus'])->group(function () {
    Route::get('/account', [AccountController::class, 'account'])->name('account');

    Route::post('/updateProfile', [AccountController::class, 'updateProfile'])->name('your.route.name');
    Route::post('/profile/update-password', [AccountController::class, 'updatePassword'])->name('profile.update.password');

    // chi tiết đơn hàng truyền id bảng bill
    Route::get('order-details/{id?}', [HomeController::class, 'detailBill'])
        ->where('id', '[0-9]+') // Ensure that {id} is numeric if provided
        ->name('order-details');
    Route::post('/bills/{id}/cancel', [HomeController::class, 'cancelOrder'])->name('cancelOrder');
    Route::post('/bills/{bill}/complete', [HomeController::class, 'completeOrder'])->name('completeOrder');

    Route::post('/products/reviews', [ProductReviewController::class, 'storeReview'])->name('product.reviews.store');

    // Sản phẩm yêu thích
    Route::get('/wishlist',                     [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/store',              [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{wishlist}/destroy',     [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Thanh toán
    Route::get('tt-that-bai', function () {
        return view('client.tt-that-bai');
    })->name('tt-that-bai');

    Route::get('tt-thanh-cong/{bill}', function ($billId) {
        $bill = Bill::findOrFail($billId);
        return view('client.tt-thanh-cong', compact('bill'));
    })->name('tt-thanh-cong');

    Route::get('/payment/return/{voucher_id?}', [CheckoutController::class, 'returnFromVNPAY'])->name('checkout.vnpay.returnFrom');
    Route::post('/checkout/vnpay', [CheckoutController::class, 'processVNPAY'])->name('checkout.vnpay');

    Route::post('/checkouts', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/checkouts', [CheckoutController::class, 'checkout'])->name('checkouts');

    // momo
    Route::post('/payment/momo', [CheckoutController::class, 'paymentMOMO'])->name('checkout.momo');
    Route::get('/checkout/momo/return', [CheckoutController::class, 'returnFromMOMO'])->name('checkout.momo.returnFrom');

    // Liên hệ
    Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
    Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

    // mua ngay
    Route::get('/buy-now', [CheckoutController::class, 'buyNow'])->name('buy.now');
    Route::post('/buy-now/process', [CheckoutController::class, 'processBuyNow'])->name('buy.now.process');
    Route::get('/checkout/vnpay/return/{voucher_id?}', [CheckoutController::class, 'vnpayReturn'])->name('checkout.vnpay.return');

    //trang giỏ hàng
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/voucher', [CartController::class, 'applyVoucher'])->name('cart.voucher');
    Route::post('/cart/update-all', [CartController::class, 'updateAll'])->name('cart.updateAll');
});







// show sp mới limit8

Route::get('/', [ClientProductController::class, 'showNewProducts'])->name('/');

// chi tiết sp
Route::get('/product/{id}', [ClientProductController::class, 'show'])->name('product-detail');
// trang sản phẩm (có bộ lọc)
Route::get('/shop/filter', [ClientProductController::class, 'filterProducts'])->name('shop.filter');
Route::get('/shop/page', [ClientProductController::class, 'paginateProducts'])->name('shop.paginate');
Route::get('/shop/filter/price', [ClientProductController::class, 'filterByPrice'])->name('shop.filter.price');


//tìm kiếm theo tên sản phẩm
Route::get('/search', [ProductController::class, 'search'])->name('search');



//chat
