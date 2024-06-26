<?php

use Illuminate\Support\Facades\Route;
use App\Modules\OrderDetail\Http\Controllers\OrderDetailController;

Route::name('order.')->prefix('/order')->group(function () {
    Route::get('/', [OrderDetailController::class, 'index'])->name('index');
    Route::get('/{order:uuid}', [OrderDetailController::class, 'show'])->name('show');
    Route::post('/store-order', [OrderDetailController::class, 'store'])->name('store');
    Route::post('/cancel-order', [OrderDetailController::class, 'cancelOrder'])->name('cancel-order');
});
