<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductSizeController;

Route::group(['prefix' => 'dashboard/size'], function () {
    Route::get('/', [ProductSizeController::class, 'index'])->name('dashboard.size.index');
    Route::get('/create', [ProductSizeController::class, 'create'])->name('dashboard.size.create');
    Route::post('/store', [ProductSizeController::class, 'store'])->name('dashboard.size.store');
    Route::get('/edit/{id}', [ProductSizeController::class, 'edit'])->name('dashboard.size.edit');
    Route::put('/update/{id}', [ProductSizeController::class, 'update'])->name('dashboard.size.update');
    Route::delete('/delete/{id}', [ProductSizeController::class, 'destroy'])->name('dashboard.size.destroy');
});
