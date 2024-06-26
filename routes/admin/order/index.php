<?php

use Illuminate\Support\Facades\Route;

use App\Modules\Admin\Order\Http\Controllers\OrderController;

Route::prefix('order')->name('order.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::get('/{order:uuid}', [OrderController::class, 'show'])->name('show');
    Route::get('/{user:id}/list', [OrderController::class, 'getOrderByUser'])->name('show-order-user');
    Route::post('/update-status', [OrderController::class, 'updateStatus'])->name('update-status');
});

