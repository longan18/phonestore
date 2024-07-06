<?php

use App\Modules\Admin\ {
    ProductSmartphone\Http\Controllers\ProductSmartphoneController,
    ProductSmartphonePrice\Http\Controllers\ProductSmartphonePriceController,
    Product\Http\Controllers\ProductController
};

use Illuminate\Support\Facades\Route;

// product smartphone
Route::prefix('product-smartphone')->name('smartphone.')->group(function () {
    Route::get('/', [ProductSmartphoneController::class, 'index'])->name('index');
    Route::get('/create', [ProductSmartphoneController::class, 'create'])->name('create');
    Route::get('/{product:slug}/show', [ProductSmartphoneController::class, 'show'])->name('show');
    Route::post('/', [ProductSmartphoneController::class, 'store'])->name('store');
    Route::post('/{product:id}/update', [ProductSmartphoneController::class, 'update'])->name('update');
});

// product smartphone option
Route::prefix('product-smartphone')->name('smartphone.option.')->group(function () {
    Route::get('/{product:slug}/options', [ProductSmartphonePriceController::class, 'index'])->name('index');
    Route::get('/{product:slug}/option/create', [ProductSmartphonePriceController::class, 'create'])->name('create');
    Route::get('/{product:slug}/option/{option:id}/show', [ProductSmartphonePriceController::class, 'show'])->name('show');
    Route::post('/option', [ProductSmartphonePriceController::class, 'store'])->name('store');
    Route::post('/{option:id}/option/update', [ProductSmartphonePriceController::class, 'update'])->name('update');
    Route::post('/option/{option:id}/update-status', [ProductSmartphonePriceController::class, 'updateStatus'])->name('update-status');
    Route::delete('/{option:id}/options', [ProductSmartphonePriceController::class, 'deleteOption'])->name('delete-option');
});

// update status product
Route::post('/{product:slug}/update-status', [ProductController::class, 'updateStatus'])->name('product.update-status');

