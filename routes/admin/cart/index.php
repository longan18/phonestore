<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Cart\Http\Controllers\CartController;

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/{user:id}/list', [CartController::class, 'index'])->name('index');
});

