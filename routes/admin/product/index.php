<?php

use App\Modules\Admin\ {
    ProductSmartphone\Http\Controllers\ProductSmartphoneController,
    ProductSmartphonePrice\Http\Controllers\ProductSmartphonePriceController
};

use Illuminate\Support\Facades\Route;

Route::prefix('product-smartphone')->name('smartphone.')->group(function () {
    Route::get('/', [ProductSmartphoneController::class, 'index'])->name('index');
    Route::post('/', [ProductSmartphoneController::class, 'handle'])->name('handle');
    Route::get('/create', [ProductSmartphoneController::class, 'create'])->name('create');
    Route::get('/{product:slug}/show', [ProductSmartphoneController::class, 'show'])->name('show');

    // product smartphone option
    Route::post('/option', [ProductSmartphonePriceController::class, 'handle'])->name('handle-option');
    Route::get('/{product:slug}/options', [ProductSmartphonePriceController::class, 'index'])->name('show-list-option');
    Route::get('/{product:slug}/option/create', [ProductSmartphonePriceController::class, 'create'])->name('create-option');
    Route::get('/{product:slug}/option/{id}/show', [ProductSmartphonePriceController::class, 'show'])->name('show-option');
});
