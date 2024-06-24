<?php

use Illuminate\Support\Facades\Route;

use App\Modules\Admin\Order\Http\Controllers\OrderController;

Route::prefix('order')->name('order.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{user:id}/list', [OrderController::class, 'getOrderByUser'])->name('show-order-user');
});

