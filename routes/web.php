<?php

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
// ...

// Client

Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::post('/login', [AccountController::class, 'loginSubmit'])->name('loginSubmit');

Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/register', [AccountController::class, 'registerSubmit'])->name('registerSubmit');

Route::get('/logout', [AccountController::class, 'logout'])->name('logout');        

Route::get('/account', [AccountController::class, 'account'])
    ->name('account')
    ->middleware('auth');